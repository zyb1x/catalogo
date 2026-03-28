<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaypalController extends Controller
{
    private function apiUrl(string $path): string
    {
        return config('app.api_url') . '/api' . $path;
    }

    public function iniciarPago($idPrestamo)
    {
        if (!session('api_token')) {
            return redirect()->route('login')->with('error', 'Sesión expirada.');
        }

        $respuesta = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('api_token'),
            'Accept'        => 'application/json',
        ])->get($this->apiUrl("/prestamos/{$idPrestamo}"));

        if (!$respuesta->successful()) {
            return redirect()->route('pedidos.index')->with('error', 'Pedido no encontrado.');
        }

        $pedido = $respuesta->json()['datos'];

        if (($pedido['estado_pago'] ?? null) === 'COMPLETADO') {
            return redirect()->route('pedidos.show', $idPrestamo)
                ->with('error', 'Este pedido ya fue pagado.');
        }

        $total = $pedido['total'] ?? 0;

        $respuestaPaypal = Http::post($this->apiUrl('/paypal/pago'), [
            'id_prestamo' => $idPrestamo,
            'total'       => $total,
            'token'       => session('api_token'),
        ]);

        $datos = $respuestaPaypal->json();

        if (!$respuestaPaypal->successful() || !($datos['resultado'] ?? false)) {
            return redirect()->route('pedidos.show', $idPrestamo)
                ->with('error', 'No se pudo iniciar el pago con PayPal: ' . ($datos['error'] ?? ''));
        }

        session([
            'paypal_order_id' => $datos['order_id'],
            'paypal_prestamo' => $idPrestamo,
        ]);

        return redirect($datos['approval_url']);
    }

    public function pagoExitoso(Request $request)
    {
        $idPrestamo = $request->query('id_prestamo');
        $orderId    = $request->query('token'); // ← PayPal envía el order_id como 'token' en la URL
        $apiToken   = session('api_token');

        if (!$orderId || !$idPrestamo) {
            return redirect()->route('pedidos.index')
                ->with('error', 'Error al procesar el pago.');
        }

        $respuesta = Http::post($this->apiUrl('/paypal/procesar-pago'), [
            'order_id'    => $orderId,
            'id_prestamo' => $idPrestamo,
        ]);

        $datos = $respuesta->json();

        session()->forget(['paypal_order_id', 'paypal_prestamo']);

        if (!$respuesta->successful() || !($datos['resultado'] ?? false)) {
            return redirect()->route('pedidos.show', $idPrestamo)
                ->with('error', 'El pago no pudo completarse: ' . ($datos['error'] ?? ''));
        }

        $transaccionId = $datos['transaccion_id'];

        if ($apiToken) {
            Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiToken,
                'Accept'        => 'application/json',
            ])->patch($this->apiUrl("/prestamos/{$idPrestamo}/pago"), [
                'transaccion_id' => $transaccionId,
                'estado_pago'    => 'COMPLETADO',
            ]);
        }

        return redirect()->route('pedidos.show', $idPrestamo)
            ->with('success', "¡Pago completado! ID de transacción: {$transaccionId}");
    }

    public function pagoCancelado(Request $request)
    {
        $idPrestamo = $request->query('id_prestamo');
        session()->forget(['paypal_order_id', 'paypal_prestamo']);

        return redirect()->route('pedidos.show', $idPrestamo)
            ->with('error', 'El pago fue cancelado. Puedes intentarlo de nuevo.');
    }
}

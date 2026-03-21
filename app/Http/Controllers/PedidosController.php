<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PedidosController extends Controller
{
    
    private function apiHeaders(): array
    {
        return [
            'Authorization' => 'Bearer ' . session('api_token'),
            'Accept'        => 'application/json',
        ];
    }

    // Helper: URL base de la API
    private function apiUrl(string $path): string
    {
        return config('app.api_url') . '/api' . $path;
    }


    public function confirmar(Request $request)
    {
        $carrito = session('carrito', []);

        if (empty($carrito)) {
            return redirect()->route('carrito.index')
                ->with('error', 'El carrito está vacío.');
        }

        if (!session('api_token')) {
            return redirect()->route('carrito.index')
                ->with('error', 'No se pudo autenticar con el sistema. Vuelve a iniciar sesión.');
        }

       
        $items = array_map(fn($item) => [
            'id_herramienta' => $item['id_herramienta'],
            'cantidad'       => $item['cantidad'],
        ], array_values($carrito));

      
        $respuesta = Http::withHeaders($this->apiHeaders())
            ->post($this->apiUrl('/prestamos'), [
                'items' => $items,
            ]);

        $datos = $respuesta->json();

        if (!$respuesta->successful() || !($datos['resultado'] ?? false)) {
            $error = $datos['error'] ?? 'Error al crear el pedido.';
            if (is_array($error)) {
                $error = implode(' ', array_merge(...array_values($error)));
            }
            return redirect()->route('carrito.index')->with('error', $error);
        }

       
        session()->forget('carrito');

        $idPedido = $datos['datos'];

        return redirect()->route('pedidos.show', $idPedido)
            ->with('success', "¡Pedido #{$idPedido} creado exitosamente!");
    }


    public function index()
    {
        if (!session('api_token')) {
            return redirect()->route('login')
                ->with('error', 'Sesión expirada. Vuelve a iniciar sesión.');
        }

        $respuesta = Http::withHeaders($this->apiHeaders())
            ->get($this->apiUrl('/prestamos'));

        $pedidos = [];
        $errorApi = null;

        if ($respuesta->successful()) {
            $datos   = $respuesta->json();
            $pedidos = $datos['datos'] ?? [];
        } else {
            $errorApi = 'No se pudieron cargar los pedidos.';
        }

        return view('pedidos.index', compact('pedidos', 'errorApi'));
    }

  
    public function show($id)
    {
        if (!session('api_token')) {
            return redirect()->route('login')
                ->with('error', 'Sesión expirada. Vuelve a iniciar sesión.');
        }

        $respuesta = Http::withHeaders($this->apiHeaders())
            ->get($this->apiUrl("/prestamos/{$id}"));

        if (!$respuesta->successful()) {
            return redirect()->route('pedidos.index')
                ->with('error', 'Pedido no encontrado.');
        }

        $datos   = $respuesta->json();
        $pedido  = $datos['datos'] ?? null;

        return view('pedidos.show', compact('pedido'));
    }

  
    public function cancelar($id)
    {
        if (!session('api_token')) {
            return redirect()->route('login')
                ->with('error', 'Sesión expirada. Vuelve a iniciar sesión.');
        }

        $respuesta = Http::withHeaders($this->apiHeaders())
            ->patch($this->apiUrl("/prestamos/{$id}/cancelar"));

        $datos = $respuesta->json();

        if (!$respuesta->successful() || !($datos['resultado'] ?? false)) {
            $error = $datos['error'] ?? 'No se pudo cancelar el pedido.';
            return redirect()->route('pedidos.show', $id)->with('error', $error);
        }

        return redirect()->route('pedidos.index')
            ->with('success', "Pedido #{$id} cancelado correctamente.");
    }
}

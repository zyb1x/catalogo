<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarritoController extends Controller
{

    // GET /carrito
    public function index()
    {
        $carrito       = session('carrito', []);
        $totalUnidades = array_sum(array_column($carrito, 'cantidad'));
        $totalPrecio   = array_sum(array_map(
            fn($item) => ($item['precio'] ?? 0) * $item['cantidad'],
            $carrito
        ));

        return view('carrito.carrito', compact('carrito', 'totalUnidades', 'totalPrecio'));
    }

    // POST /carrito/agregar
    public function agregar(Request $request)
    {
        $id         = $request->input('id_herramienta');
        $nombre     = $request->input('nombre_herramienta');
        $existencia = (int) $request->input('existencia', 100);
        $imagen     = $request->input('imagen');
        $cantidad   = max(1, (int) $request->input('cantidad', 1));
        $precio     = (float) $request->input('precio', 0);   // ← nuevo

        $carrito = session('carrito', []);

        if (isset($carrito[$id])) {
            $carrito[$id]['cantidad'] = min(
                $carrito[$id]['cantidad'] + $cantidad,
                $existencia
            );
        } else {
            $carrito[$id] = [
                'id_herramienta'     => $id,
                'nombre_herramienta' => $nombre,
                'existencia'         => $existencia,
                'imagen'             => $imagen,
                'precio'             => $precio,          // ← nuevo
                'cantidad'           => min($cantidad, $existencia),
            ];
        }

        session(['carrito' => $carrito]);

        return redirect()->route('carrito.index')
            ->with('success', 'Herramienta agregada al carrito.');
    }

    // POST /carrito/actualizar
    public function actualizar(Request $request)
    {
        $id         = $request->input('id_herramienta');
        $cantidad   = max(1, (int) $request->input('cantidad', 1));
        $existencia = (int) $request->input('existencia', 9999);

        $carrito = session('carrito', []);

        if (isset($carrito[$id])) {
            $carrito[$id]['cantidad'] = min($cantidad, $existencia);
            session(['carrito' => $carrito]);
        }

        return redirect()->route('carrito.index')
            ->with('success', 'Cantidad actualizada.');
    }

    // POST /carrito/eliminar
    public function eliminar(Request $request)
    {
        $id      = $request->input('id_herramienta');
        $carrito = session('carrito', []);

        unset($carrito[$id]);
        session(['carrito' => $carrito]);

        return redirect()->route('carrito.index')
            ->with('success', 'Herramienta eliminada del carrito.');
    }

    // POST /carrito/vaciar
    public function vaciar()
    {
        session()->forget('carrito');
        return redirect()->route('carrito.index')
            ->with('success', 'Carrito vaciado.');
    }
}

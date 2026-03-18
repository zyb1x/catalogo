<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HerramientasController extends Controller
{

    private string $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('app.api_url');
    }
    // GET /herramientas
    public function index()
    {
        $response = Http::get("{$this->apiUrl}/api/herramientas");

        $herramientas = [];
        if ($response->successful()) {
            $json = $response->object();
            if ($json->resultado) {
                $herramientas = $json->datos;
            } else {
                return redirect()->back()->with('error', $json->error);
            }
        }

        return view('herramientas.herramientas', compact('herramientas'));
    }

    // GET /herramientas/listado
    public function listado()
    {
        $response = Http::get("{$this->apiUrl}/api/herramientas");

        $herramientas = collect(); 
        if ($response->successful()) {
            $json = $response->object();
            if ($json->resultado) {
                
                $herramientas = collect($json->datos);
            } else {
                return redirect()->back()->with('error', $json->error);
            }
        }

        return view('herramientas.listado', compact('herramientas'));
    }

    // GET /herramientas/crear 
    public function create()
    {
        $response  = Http::get("{$this->apiUrl}/api/categorias");
        $categorias = $response->successful() ? $response->object()->datos : [];
        return view('herramientas.formulario-crear', compact('categorias'));
    }
    // POST /herramientas/store
    public function store(Request $request)
    {
        $request->validate([
            'id_categoria'       => 'required',
            'nombre_herramienta' => 'required',
            'existencia'         => 'required|integer',
            'imagen'             => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'id_categoria.required'       => 'La categoría es obligatoria.',
            'nombre_herramienta.required' => 'El nombre de la herramienta es obligatorio.',
            'existencia.required'         => 'La existencia es obligatoria.',
            'existencia.integer'          => 'La existencia debe ser un número entero.',
            'imagen.required'             => 'La imagen es obligatoria.',
            'imagen.image'                => 'El archivo debe ser una imagen.',
            'imagen.mimes'                => 'La imagen debe ser de tipo: jpeg, png, jpg.',
            'imagen.max'                  => 'La imagen no debe superar los 2MB.',
        ]);

        $datos = [
            'id_categoria'       => $request->id_categoria,
            'nombre_herramienta' => $request->nombre_herramienta,
            'existencia'         => $request->existencia,
        ];

        if ($request->hasFile('imagen')) {
            $response = Http::attach(
                'imagen',
                file_get_contents($request->file('imagen')->getRealPath()),
                'herramienta.jpg'
            )->post("{$this->apiUrl}/api/herramientas", $datos);
        } else {
            $response = Http::post("{$this->apiUrl}/api/herramientas", $datos);
        }

        if ($response->successful()) {
            $json = $response->object();
            if ($json->resultado) {
                return redirect()->route('herramientas.listado')->with('success', 'Herramienta añadida exitosamente.');
            }
            return redirect()->back()->with('error', $json->error);
        }

        return redirect()->back()->with('error', 'Error al conectar con la API.');
    }

    // GET /herramientas/{id}/editar
    public function edit($id)
    {
        $responseH = Http::get("{$this->apiUrl}/api/herramientas/{$id}");
        $responseC = Http::get("{$this->apiUrl}/api/categorias");

        if ($responseH->successful() && $responseC->successful()) {
            $herramienta = $responseH->object()->datos;
            $categorias  = $responseC->object()->datos;
            return view('herramientas.formulario-editar', compact('herramienta', 'categorias'));
        }

        return redirect()->back()->with('error', 'Error al conectar con la API.');
    }

    // POST /herramientas/{id}/actualizar 
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_categoria'       => 'required',
            'nombre_herramienta' => 'required',
            'existencia'         => 'required|integer',
            'imagen'             => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'id_categoria.required'       => 'La categoría es obligatoria.',
            'nombre_herramienta.required' => 'El nombre de la herramienta es obligatorio.',
            'existencia.required'         => 'La existencia es obligatoria.',
            'existencia.integer'          => 'La existencia debe ser un número entero.',
            'imagen.image'                => 'El archivo debe ser una imagen.',
            'imagen.mimes'                => 'La imagen debe ser de tipo: jpeg, png, jpg.',
            'imagen.max'                  => 'La imagen no debe superar los 2MB.',
        ]);

        $datos = [
            'id_categoria'       => $request->id_categoria,
            'nombre_herramienta' => $request->nombre_herramienta,
            'existencia'         => $request->existencia,
            'eliminar_imagen'    => $request->input('eliminar_imagen', '0'),
            '_method'            => 'PUT', //spoofing para que la API lo trate como PUT
        ];

        if ($request->hasFile('imagen')) {
            $response = Http::attach(
                'imagen',
                file_get_contents($request->file('imagen')->getRealPath()),
                'herramienta.jpg'
            )->post("{$this->apiUrl}/api/herramientas/{$id}", $datos);
        } else {
            $response = Http::post("{$this->apiUrl}/api/herramientas/{$id}", $datos);
        }

        if ($response->successful()) {
            $json = $response->object();
            if ($json->resultado) {
                return redirect()->route('herramientas.listado')->with('success', 'Herramienta actualizada exitosamente.');
            }
            return redirect()->back()->with('error', $json->error);
        }

        return redirect()->back()->with('error', 'Error al conectar con la API.');
    }

    // DELETE /herramientas/{id}
    public function destroy($id)
    {
        $response = Http::delete("{$this->apiUrl}/api/herramientas/{$id}");

        if ($response->successful()) {
            $json = $response->object();
            if ($json->resultado) {
                return redirect()->route('herramientas.listado')->with('success', 'Estatus cambiado a no disponible exitosamente.');
            }
            return redirect()->back()->with('error', $json->error);
        }

        return redirect()->back()->with('error', 'Error al conectar con la API.');
    }
}

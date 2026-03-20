<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PerfilController extends Controller
{
    protected $apiUrl = 'http://localhost:8000/api';

    // Ver perfil
    public function index()
    {
        $response = Http::withToken(session('api_token'))
            ->get("{$this->apiUrl}/user");

        if ($response->unauthorized()) {
            return redirect()->route('login');
        }

        $usuario = $response->json();
        return view('perfil.index', compact('usuario'));
    }


    public function actualizar(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email',
        ]);

        $response = Http::withToken(session('api_token'))
            ->put("{$this->apiUrl}/user", [
                'name'  => $request->name,
                'email' => $request->email,
            ]);

        if ($response->successful()) {
            session(['usuario' => $response->json()['user']]);
            return back()->with('success', 'Datos actualizados correctamente');
        }

        return back()->withErrors(['error' => 'Error al actualizar datos']);
    }


    public function actualizarImagen(Request $request)
    {
        $request->validate([
            'imagen' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $response = Http::withToken(session('api_token'))
            ->attach('imagen', file_get_contents($request->file('imagen')), $request->file('imagen')->getClientOriginalName())
            ->post("{$this->apiUrl}/user/imagen");

        if ($response->successful()) {
            $data = $response->json();
            $usuario = session('usuario');
            $usuario['imagen'] = $data['imagen'];
            session(['usuario' => $usuario]);
            return back()->with('success', 'Imagen actualizada correctamente');
        }

        return back()->withErrors(['error' => 'Error al actualizar imagen']);
    }


    public function actualizarContrasena(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password'         => 'required|min:6|confirmed',
        ]);

        $response = Http::withToken(session('api_token'))
            ->put("{$this->apiUrl}/user/password", [
                'current_password' => $request->current_password,
                'password'         => $request->password,
                'password_confirmation' => $request->password_confirmation,
            ]);

        if ($response->successful()) {
            return back()->with('success', 'Contraseña actualizada correctamente');
        }

        return back()->withErrors(['error' => $response->json()['message'] ?? 'Error al actualizar contraseña']);
    }
}

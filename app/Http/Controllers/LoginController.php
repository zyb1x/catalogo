<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
    protected $apiUrl = 'http://localhost:8000/api';

    
    public function showLoginForm()
    {
        return view('login.login');
    }


    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $response = Http::post("{$this->apiUrl}/login", [
            'email'    => $request->email,
            'password' => $request->password,
        ]);

        if ($response->successful()) {
            $data = $response->json();
            session([
                'api_token' => $data['access_token'],
                'usuario'   => $data['user'],
            ]);
            return redirect()->route('herramientas.index');
        }

        return back()->withErrors(['email' => 'Credenciales incorrectas']);
    }

    // formulario registro
    public function create()
    {
        return view('login.formulario-crear');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name'                  => 'required|string',
            'email'                 => 'required|email',
            'password'              => 'required|min:6',
            'password_confirmation' => 'required|same:password',
        ]);

        $response = Http::post("{$this->apiUrl}/register", [
            'name'                  => $request->name,
            'email'                 => $request->email,
            'password'              => $request->password,
            'password_confirmation' => $request->password_confirmation,
        ]);

        if ($response->successful()) {
            $data = $response->json();
            session([
                'api_token' => $data['access_token'],
                'usuario'   => $data['user'],
            ]);
            return redirect()->route('herramientas.index');
        }

        return back()->withErrors(['email' => 'Error al registrar usuario']);
    }

  
    public function logout(Request $request)
    {
        Http::withToken(session('api_token'))
            ->post("{$this->apiUrl}/logout");

        session()->forget(['api_token', 'usuario']);
        return redirect()->route('login');
    }
}

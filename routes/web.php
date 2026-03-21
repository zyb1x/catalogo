<?php

use App\Http\Controllers\HerramientasController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PedidosController;
use App\Http\Controllers\PerfilController;
//use Laravel\Socialite\Facades\Socialite;




// Rutas publicas
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/registro', [LoginController::class, 'create'])->name('registro');
Route::post('/registro/store', [LoginController::class, 'store'])->name('registro.store');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// Rutas de herramientas
Route::prefix('herramientas')->group(function () {
    Route::get('/', [App\Http\Controllers\HerramientasController::class, 'index'])->name('herramientas.index');
    Route::get('/registro', [App\Http\Controllers\HerramientasController::class, 'create'])->name('herramientas.create');
    Route::post('/store', [App\Http\Controllers\HerramientasController::class, 'store'])->name('herramientas.store');
    Route::get('/{id_herramienta}/edit', [App\Http\Controllers\HerramientasController::class, 'edit'])->name('herramientas.edit');
    Route::post('/{id_herramienta}/actualizar', [HerramientasController::class, 'update'])->name('herramientas.update');
    Route::delete('/destroy/{id_herramienta}', [App\Http\Controllers\HerramientasController::class, 'destroy'])->name('herramientas.destroy');
    Route::get('/listado', [App\Http\Controllers\HerramientasController::class, 'listado'])->name('herramientas.listado');
});


// Google Auth
// Route::get('auth/google', function () {
//     return Socialite::driver('google')->redirect();
// })->name('auth.google');

// Route::get('/auth/google/callback', function () {
//     try {
//         $googleUser = Socialite::driver('google')->stateless()->user();
//         $usuario = Usuarios::where('correo', $googleUser->getEmail())->first();

//         if (!$usuario) {
//             $usuario = Usuarios::create([
//                 'nombre'     => $googleUser->getName(),
//                 'correo' => $googleUser->getEmail(),
//                 'usuario'     => $googleUser->getEmail(),
//                 'contrasena' => Hash::make(Str::random(16)),
//                 'rol'     => 'Almacenista',
//                 'turno'      => 'Matutino',
//                 'imagen'     => $googleUser->getAvatar(),
//             ]);
//         } else {
//             // Actualizar avatar por si cambia en Google
//             $usuario->update(['imagen' => $googleUser->getAvatar()]);
//         }

//         Auth::guard('usuarios')->login($usuario);
//         return redirect()->route('inicio');
//     } catch (\Exception $e) {
//         return redirect()->route('login')
//             ->withErrors(['error' => 'Error al iniciar sesión con Google: ' . $e->getMessage()]);
//     }
// });

Route::get('/inicio', function () {
    return view('inicio.inicio');
})->name('inicio');


// Detalle herramienta para el carrito
Route::get('/herramientas/{id}', [App\Http\Controllers\HerramientasController::class, 'show'])->name('herramientas.show');

Route::prefix('carrito')->name('carrito.')->group(function () {
    Route::get('/',            [App\Http\Controllers\CarritoController::class, 'index'])->name('index');
    Route::post('/agregar',    [App\Http\Controllers\CarritoController::class, 'agregar'])->name('agregar');
    Route::post('/actualizar', [App\Http\Controllers\CarritoController::class, 'actualizar'])->name('actualizar');
    Route::post('/eliminar',   [App\Http\Controllers\CarritoController::class, 'eliminar'])->name('eliminar');
    Route::post('/vaciar',     [App\Http\Controllers\CarritoController::class, 'vaciar'])->name('vaciar');
});


 
    Route::post('/pedidos/confirmar',        [PedidosController::class, 'confirmar'])->name('pedidos.confirmar');
    Route::get ('/pedidos',                  [PedidosController::class, 'index'])    ->name('pedidos.index');
    Route::get ('/pedidos/{id}',             [PedidosController::class, 'show'])     ->name('pedidos.show');
    Route::post('/pedidos/{id}/cancelar',    [PedidosController::class, 'cancelar']) ->name('pedidos.cancelar');



Route::get('/', function () {
    return redirect()->route('login');
});


// Info sobre perfil autenticado
Route::prefix('perfil')->name('perfil.')->group(function () {
    Route::get('/',                [PerfilController::class, 'index'])->name('index');
    Route::put('/actualizar',      [PerfilController::class, 'actualizar'])->name('actualizar');
    Route::post('/imagen',         [PerfilController::class, 'actualizarImagen'])->name('imagen');
    Route::put('/contrasena',      [PerfilController::class, 'actualizarContrasena'])->name('contrasena');
});

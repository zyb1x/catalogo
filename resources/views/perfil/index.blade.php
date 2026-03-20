@extends('plantilla.app')

@section('titulo', 'Mi Perfil')

@section('contenido')

    <div class="max-w-2xl mx-auto px-4 py-8">

        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded-lg mb-6">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 rounded-lg mb-6">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <div class="bg-[#023047] rounded-lg p-8">

            {{-- Encabezado --}}
            <div class="flex items-center gap-4 mb-8 pb-6 border-b border-gray-600">
                <div
                    class="w-14 h-14 rounded-full bg-orange-500 flex items-center justify-center text-white text-2xl font-bold">
                    {{ strtoupper(substr($usuario['name'], 0, 1)) }}
                </div>
                <div>
                    <h1 class="text-xl font-bold text-white">{{ $usuario['name'] }}</h1>
                    <p class="text-gray-400 text-sm">{{ $usuario['email'] }}</p>
                </div>
            </div>

            {{-- Datos generales --}}
            <h2 class="text-white font-semibold mb-4">Datos generales</h2>
            <form action="{{ route('perfil.actualizar') }}" method="POST" class="mb-8 pb-8 border-b border-gray-600">
                @csrf @method('PUT')
                <div class="grid gap-4 sm:grid-cols-2 mb-4">
                    <div>
                        <label class="block mb-2 text-sm text-gray-300">Nombre</label>
                        <input type="text" name="name" value="{{ $usuario['name'] }}"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg block w-full p-2.5"
                            required>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm text-gray-300">Correo</label>
                        <input type="email" name="email" value="{{ $usuario['email'] }}"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg block w-full p-2.5"
                            required>
                    </div>
                </div>
                <button type="submit"
                    class="text-white bg-[#fb5607] hover:bg-orange-600 font-medium rounded-lg text-sm px-5 py-2.5">
                    Guardar cambios
                </button>
            </form>

            {{-- Imagen --}}
            <h2 class="text-white font-semibold mb-4">Imagen de perfil</h2>
            {{-- Mostrar imagen actual --}}
            <div class="mb-4">
                @if ($usuario['imagen'])
                    <img src="http://localhost:8000/storage/{{ $usuario['imagen'] }}" alt="Foto de perfil"
                        class="w-20 h-20 rounded-full object-cover border-2 border-orange-500">
                @else
                    <div
                        class="w-20 h-20 rounded-full bg-gray-600 flex items-center justify-center text-white text-2xl font-bold">
                        {{ strtoupper(substr($usuario['name'], 0, 1)) }}
                    </div>
                @endif
            </div>

            <form action="{{ route('perfil.imagen') }}" method="POST" enctype="multipart/form-data"
                class="mb-8 pb-8 border-b border-gray-600">
                @csrf
                <input type="file" name="imagen" accept="image/*"
                    class="block w-full text-sm text-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-[#fb5607] file:text-white mb-4">
                <button type="submit" class="text-white bg-[#fb5607]  font-medium rounded-lg text-sm px-5 py-2.5">
                    Actualizar imagen
                </button>
            </form>

            {{-- Contraseña --}}
            <h2 class="text-white font-semibold mb-4">Cambiar contraseña</h2>
            <form action="{{ route('perfil.contrasena') }}" method="POST">
                @csrf @method('PUT')
                <div class="grid gap-4 mb-4">
                    <div>
                        <label class="block mb-2 text-sm text-gray-300">Contraseña actual</label>
                        <input type="password" name="current_password" placeholder="••••••••"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg block w-full p-2.5"
                            required>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm text-gray-300">Nueva contraseña (mínimo 6 caracteres)</label>
                        <input type="password" name="password" placeholder="••••••••"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg block w-full p-2.5"
                            required>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm text-gray-300">Confirmar contraseña</label>
                        <input type="password" name="password_confirmation" placeholder="••••••••"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg block w-full p-2.5"
                            required>
                    </div>
                </div>
                <button type="submit"
                    class="text-white bg-[#fb5607] hover:bg-orange-600 font-medium rounded-lg text-sm px-5 py-2.5">
                    Cambiar contraseña
                </button>
            </form>

        </div>
    </div>

@endsection

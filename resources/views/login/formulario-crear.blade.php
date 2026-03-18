@extends('plantilla.app')

@section('titulo', 'registro')

@section('contenido')

    <section class="bg-white dark:bg-White">
        <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16 bg-[#023047] rounded-lg shadow dark:bg-[#023047] mt-8 mb-10">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Regístrate</h2>
            {{-- @if ($errors->any())
                <div class="bg-red-500 text-white p-4 rounded-lg mb-4">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif --}}
            <form action="/registro/store" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">

                    <div class="sm:col-span-2">
                        <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre
                            Completo</label>
                        <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            @error('nombre')
                                style="border: 1px solid #ef4444; box-shadow: 0 0 0 1px #ef4444;"    {{-- ← borde rojo si hay error --}}
                            @else
                                border-gray-300 dark:border-gray-600  {{-- ← borde normal si no hay error --}}
                            @enderror
                            placeholder="Nombre Completo">
                        @error('nombre')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="correo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Correo
                            Electrónico</label>
                        <input type="text" name="correo" id="correo" value="{{ old('correo') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            @error('correo')
                                style="border: 1px solid #ef4444; box-shadow: 0 0 0 1px #ef4444;"
                            @else
                                border-gray-300 dark:border-gray-600  
                            @enderror
                            placeholder="ejemplo@herramientas.com">
                        @error('correo')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="usuario" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Usuario
                        </label>
                        <input type="text" name="usuario" id="usuario" value="{{ old('usuario') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            @error('usuario')
                                style="border: 1px solid #ef4444; box-shadow: 0 0 0 1px #ef4444;"
                            @else
                                border-gray-300 dark:border-gray-600  
                            @enderror
                            placeholder="Usuario">
                        @error('usuario')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="contrasena"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contraseña (Mínimo 6
                            caracteres)</label>
                        <input type="password" name="contrasena" id="contrasena"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            @error('contrasena')
                                style="border: 1px solid #ef4444; box-shadow: 0 0 0 1px #ef4444;"
                            @else
                                border-gray-300 dark:border-gray-600  
                            @enderror
                            placeholder="••••••">
                        @error('contrasena')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="conf_contrasena"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirmar
                            Contraseña</label>
                        <input type="password" name="conf_contrasena" id="conf_contrasena"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            @error('conf_contrasena')
                                style="border: 1px solid #ef4444; box-shadow: 0 0 0 1px #ef4444;"
                            @else
                                border-gray-300 dark:border-gray-600  
                            @enderror
                            placeholder="••••••">
                        @error('conf_contrasena')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="rol"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rol</label>
                        <select name="rol" id="rol"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            @error('rol')
                                style="border: 1px solid #ef4444; box-shadow: 0 0 0 1px #ef4444;"
                            @else
                                border-gray-300 dark:border-gray-600
                            @enderror>
                            <option value="" selected disabled>Selecciona el rol</option>
                            <option value="Administrador">Administrador</option>
                            <option value="Almacenista">Almacenista</option>
                        </select>
                        @error('rol')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="turno"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Turno</label>
                        <select name="turno" id="turno"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            @error('turno')
                                style="border: 1px solid #ef4444; box-shadow: 0 0 0 1px #ef4444;"
                            @else
                                border-gray-300 dark:border-gray-600
                            @enderror>
                            <option value="" selected disabled>Selecciona el turno</option>
                            <option value="Matutino">Matutino</option>
                            <option value="Vespertino">Vespertino</option>
                            <option value="Nocturno">Nocturno</option>
                        </select>
                        @error('turno')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror

                    </div>


                    <div class="sm:col-span-2 flex items-center justify-center w-full">
                        <label for="dropzone-file"
                            class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:bg-gray-700 dark:hover:bg-gray-800"
                            @error('imagen') 
            style="border-color: #ef4444; box-shadow: 0 0 0 1px #ef4444;" 
        @else 
            style="border-color: #4b5563;" 
        @enderror>
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                </svg>
                                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                                    <span class="font-semibold">Click para subir</span> o arrastra imagen
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    PNG, JPG (Max. 2MB)
                                </p>
                            </div>
                            <input id="dropzone-file" name="imagen" type="file" class="hidden" />
                        </label>
                    </div>
                    @error('imagen')
                        <p class="sm:col-span-2 mt-1 text-sm" style="color: #ef4444;">{{ $message }}</p>
                    @enderror

                    <div id="file-list" class="sm:col-span-2 mt-4 space-y-2 hidden"></div>

                </div>

                <script>
                    document.getElementById('dropzone-file').addEventListener('change', function(e) {
                        const fileList = document.getElementById('file-list');
                        fileList.innerHTML = '';
                        fileList.classList.remove('hidden');

                        Array.from(e.target.files).forEach((file, index) => {
                            const fileElement = document.createElement('div');
                            fileElement.className =
                                'flex items-center justify-between p-3 bg-gray-100 dark:bg-gray-800 rounded-lg';
                            fileElement.innerHTML =
                                `
                                <div class="flex items-center space-x-3">
                                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="text-sm text-gray-700 dark:text-gray-300 truncate">${file.name}</span>
                                </div>
                                <span class="text-xs text-gray-500 dark:text-gray-400">${(file.size / 1024 / 1024).toFixed(2)} MB</span>`;
                            fileList.appendChild(fileElement);
                        });
                    });
                </script>


                <button type="submit"
                    class="w-full text-white bg-[#fb5607] hover:bg-orange-600 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mt-6">
                    Continuar
                </button>

            </form>
        </div>
    </section>

@endsection

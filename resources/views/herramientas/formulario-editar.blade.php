@extends('plantilla.app')

@section('titulo', 'editar herramientas')


@section('contenido')

    <section class="bg-white dark:bg-White">
        <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16 bg-[#023047] rounded-lg shadow dark:bg-[#023047] mt-20 mb-20">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Editar Herramienta</h2>
            {{-- @if ($errors->any())
                <div class="bg-red-500 text-white p-4 rounded-lg mb-4">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif --}}
            <form action="/herramientas/{{ $herramienta->id_herramienta }}/actualizar" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">

                    <div class="sm:col-span-2">
                        <label for="nombre_herramienta"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre
                            de la herramienta</label>
                        <input type="text" name="nombre_herramienta" id="nombre_herramienta"
                            value="{{ $herramienta->nombre_herramienta }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            @error('nombre_herramienta')
                                style="border: 1px solid #ef4444; box-shadow: 0 0 0 1px #ef4444;"    
                            @else
                                border-gray-300 dark:border-gray-600  
                            @enderror
                            placeholder="Nombre de la herramienta">
                        @error('nombre_herramienta')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="id_categoria"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Categoría</label>
                        <select name="id_categoria" id="id_categoria"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            @error('id_categoria')
                                 style="border: 1px solid #ef4444; box-shadow: 0 0 0 1px #ef4444;"
                            @else
                                border-gray-300 dark:border-gray-600  
                            @enderror>

                            <option value="" selected disabled>Selecciona una categoría</option>

                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id_categoria }}"
                                    {{ $herramienta->id_categoria == $categoria->id_categoria ? 'selected' : '' }}>
                                    {{ $categoria->nombre_categoria }}
                                </option>
                            @endforeach

                        </select>
                        @error('id_categoria')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="existencia"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Existencia</label>
                        <input type="number" name="existencia" id="existencia" value="{{ $herramienta->existencia }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            @error('existencia')
                                style="border: 1px solid #ef4444; box-shadow: 0 0 0 1px #ef4444;"
                            @else
                                border-gray-300 dark:border-gray-600  
                            @enderror
                            placeholder="Ingrese la cantidad en existencia">
                        @error('existencia')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="sm:col-span-2 flex flex-col items-center justify-center w-full gap-3">

                        {{-- Vista previa de imagen actual --}}
                        <div id="current-image"
                            class="{{ $herramienta->imagen && !str_contains($herramienta->imagen, 'producto_default') ? '' : 'hidden' }} w-full">
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">Imagen actual:</p>
                            <div class="relative inline-block">
                                <img id="preview-img"
                                    src="{{ $herramienta->imagen ? config('app.api_url') . $herramienta->imagen : '' }}"
                                    alt="Imagen herramienta"
                                    class="h-32 w-auto rounded-lg object-cover border border-gray-300 dark:border-gray-600">
                                <button type="button" id="remove-image"
                                    class="absolute -top-2 -right-2 bg-red-500 hover:bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs font-bold shadow">
                                    ✕
                                </button>
                            </div>
                        </div>

                        {{-- Input oculto para marcar si se eliminó la imagen --}}
                        <input type="hidden" name="eliminar_imagen" id="eliminar_imagen" value="0">

                        {{-- Dropzone (oculto si hay imagen) --}}
                        <label for="dropzone-file" id="dropzone"
                            class="{{ $herramienta->imagen ? 'hidden' : '' }} flex flex-col items-center justify-center w-full h-32 border-2 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:bg-gray-700 dark:hover:bg-gray-800"
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
                                <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG (Max. 2MB)</p>
                            </div>
                            <input id="dropzone-file" name="imagen" type="file" accept="image/*" class="hidden" />
                        </label>

                        @error('imagen')
                            <p class="sm:col-span-2 mt-1 text-sm" style="color: #ef4444;">{{ $message }}</p>
                        @enderror

                        <div id="file-list" class="w-full mt-2 space-y-2 hidden"></div>
                    </div>

                    <script>
                        const dropzone = document.getElementById('dropzone');
                        const currentImage = document.getElementById('current-image');
                        const removeBtn = document.getElementById('remove-image');
                        const previewImg = document.getElementById('preview-img');
                        const fileInput = document.getElementById('dropzone-file');
                        const eliminarInput = document.getElementById('eliminar_imagen');
                        const fileList = document.getElementById('file-list');

                       
                        removeBtn.addEventListener('click', function() {
                            currentImage.classList.add('hidden');
                            dropzone.classList.remove('hidden');
                            eliminarInput.value = '1';
                            fileInput.value = '';
                            fileList.classList.add('hidden');
                            fileList.innerHTML = '';
                        });

                        
                        fileInput.addEventListener('change', function(e) {
                            const file = e.target.files[0];
                            if (!file) return;

                            
                            const reader = new FileReader();
                            reader.onload = function(event) {
                                previewImg.src = event.target.result;
                                currentImage.classList.remove('hidden');
                                dropzone.classList.add('hidden');
                                eliminarInput.value = '0';
                                // fileList.classList.add('hidden');
                            };
                            reader.readAsDataURL(file);

                            
                            fileList.innerHTML = '';
                            fileList.classList.remove('hidden');
                            const fileElement = document.createElement('div');
                            fileElement.className = 'flex items-center justify-between p-3 bg-gray-100 dark:bg-gray-800 rounded-lg';
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
                    </script>
                </div>

                <button type="submit"
                    class="w-full text-white bg-[#fb5607] hover:bg-orange-600 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mt-6">
                    Guardar
                </button>

            </form>
        </div>
    </section>

@endsection

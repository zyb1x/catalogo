@extends('plantilla.app')

@section('titulo', $herramienta->nombre_herramienta)

@section('contenido')

    <div class="max-w-5xl mx-auto px-6 py-10">

        @if (session('success'))
            <div class="mb-6 bg-green-500 text-white px-5 py-3 rounded-lg flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-[#023047] rounded-2xl border border-gray-600 shadow-xl overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-0">

                {{-- Imagen principal --}}
                <div class="bg-white flex items-center justify-center p-10 min-h-80">
                    <img src="{{ config('app.api_url') . $herramienta->imagen }}"
                        alt="{{ $herramienta->nombre_herramienta }}" class="max-h-72 object-contain drop-shadow-lg">
                </div>

                {{-- Info --}}
                <div class="p-8 flex flex-col justify-between">
                    <div>
                        <p class="text-orange-400 text-xs font-bold tracking-widest uppercase mb-2">
                            {{ $herramienta->categoria->nombre_categoria ?? 'Sin categoría' }}
                        </p>

                        <h1 class="text-white text-2xl font-bold leading-snug mb-4">
                            {{ $herramienta->nombre_herramienta }}
                        </h1>

                        <div class="flex flex-wrap gap-3 mb-6">
                            <div class="bg-gray-800 rounded-lg px-4 py-2">
                                <span class="text-gray-400 text-xs block">Existencia</span>
                                <span class="text-white text-xl font-bold">{{ $herramienta->existencia }}</span>
                            </div>
                            <div class="bg-gray-800 rounded-lg px-4 py-2">
                                <span class="text-gray-400 text-xs block">Estado</span>
                                <span
                                    class="text-orange-400 text-sm font-semibold">{{ $herramienta->estado ?? 'N/A' }}</span>
                            </div>
                            <div class="bg-gray-800 rounded-lg px-4 py-2">
                                <span class="text-gray-400 text-xs block">Disponible</span>
                                @if ($herramienta->disponible)
                                    <span class="text-green-400 text-sm font-semibold">Sí</span>
                                @else
                                    <span class="text-red-400 text-sm font-semibold">No</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Formulario agregar al carrito --}}
                    <form action="{{ route('carrito.agregar') }}" method="POST" class="mt-2">
                        @csrf
                        <input type="hidden" name="id_herramienta" value="{{ $herramienta->id_herramienta }}">
                        <input type="hidden" name="nombre_herramienta" value="{{ $herramienta->nombre_herramienta }}">
                        <input type="hidden" name="existencia" value="{{ $herramienta->existencia }}">
                        <input type="hidden" name="imagen" value="{{ $herramienta->imagen }}">

                        <div class="flex items-center gap-3 mb-4">
                            <label class="text-gray-400 text-sm">Cantidad a solicitar:</label>
                            <div class="flex items-center border border-gray-600 rounded-lg overflow-hidden">
                                <button type="button" onclick="cambiarCantidad(-1)"
                                    class="bg-gray-700 hover:bg-gray-600 text-white px-3 py-2 text-lg font-bold transition-colors">−</button>
                                <input type="number" name="cantidad" id="cantidad" value="1" min="1"
                                    max="{{ $herramienta->existencia }}"
                                    class="w-14 text-center bg-gray-800 text-white border-0 py-2 focus:outline-none focus:ring-0">
                                <button type="button" onclick="cambiarCantidad(1)"
                                    class="bg-gray-700 hover:bg-gray-600 text-white px-3 py-2 text-lg font-bold transition-colors">+</button>
                            </div>
                        </div>

                        @if ($herramienta->disponible && $herramienta->existencia > 0)
                            <button type="submit"
                                class="w-full bg-orange-500 hover:bg-orange-600 active:bg-orange-700 text-white font-semibold py-3 px-6 rounded-xl transition-colors flex items-center justify-center gap-2 text-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                Agregar al carrito
                            </button>
                        @else
                            <button disabled
                                class="w-full bg-gray-600 text-gray-400 font-semibold py-3 px-6 rounded-xl cursor-not-allowed flex items-center justify-center gap-2 text-sm">
                                No disponible
                            </button>
                        @endif
                    </form>

                    <a href="{{ route('herramientas.index') }}"
                        class="mt-4 text-center text-gray-400 hover:text-white text-sm transition-colors block">
                        ← Volver al catálogo
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function cambiarCantidad(delta) {
            const input = document.getElementById('cantidad');
            const max = parseInt(input.getAttribute('max')) || 9999;
            input.value = Math.min(max, Math.max(1, parseInt(input.value) + delta));
        }
    </script>

@endsection

@extends('plantilla.app')

@section('titulo', 'Carrito de solicitudes')

@section('contenido')

    <div class="max-w-5xl mx-auto px-6 py-10">

        <h1 class="text-2xl font-bold text-orange-400 mb-6 flex items-center gap-3">
            <svg class="w-7 h-7 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            Carrito de solicitudes
        </h1>

        @if (session('success'))
            <div id="alerta-success"
                class="mb-5 bg-green-500 text-white px-4 py-2 rounded-lg flex items-center gap-2 text-sm">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                {{ session('success') }}
            </div>
            <script>
                setTimeout(() => {
                    const alerta = document.getElementById('alerta-success');
                    if (alerta) alerta.remove();
                }, 5000);
            </script>
        @endif

        @if (empty($carrito))
            <div class="bg-[#023047] rounded-2xl border border-gray-600 p-16 text-center">
                <svg class="w-20 h-20 text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <p class="text-gray-400 text-lg mb-6">Tu carrito está vacío</p>
                <a href="{{ route('herramientas.index') }}"
                    class="bg-orange-500 hover:bg-orange-600 text-white font-semibold px-6 py-3 rounded-xl transition-colors inline-block">
                    Ver catálogo
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- Lista de herramientas --}}
                <div class="lg:col-span-2 space-y-4">
                    @foreach ($carrito as $item)
                        <div
                            class="bg-[#023047] rounded-xl border border-gray-600 p-4 flex items-center gap-4 hover:border-orange-500 transition-colors">

                            {{-- Imagen --}}
                            <div class="bg-white rounded-lg p-2 shrink-0 w-20 h-20 flex items-center justify-center">
                                <img src="{{ config('app.api_url') . $item['imagen'] }}"
                                    alt="{{ $item['nombre_herramienta'] }}" class="h-16 w-16 object-contain">
                            </div>

                            {{-- Info --}}
                            <div class="flex-1 min-w-0">
                                <h3 class="text-white font-semibold text-sm leading-snug truncate">
                                    {{ $item['nombre_herramienta'] }}
                                </h3>
                                <p class="text-gray-400 text-xs mt-1">
                                    Disponible: <span class="text-white font-semibold">{{ $item['existencia'] }} uds</span>
                                </p>
                                <p class="text-gray-400 text-xs mt-1">
                                    Solicitando: <span class="text-orange-400 font-bold">{{ $item['cantidad'] }} uds</span>
                                </p>
                            </div>


                            <div class="flex flex-col items-end gap-2 shrink-0">

                                {{-- Actualizar cantidad --}}
                                <form action="{{ route('carrito.actualizar') }}" method="POST"
                                    class="flex items-center gap-1">
                                    @csrf
                                    <input type="hidden" name="id_herramienta" value="{{ $item['id_herramienta'] }}">
                                    <input type="hidden" name="existencia" value="{{ $item['existencia'] }}">
                                    <div class="flex items-center border border-gray-500 rounded-lg overflow-hidden">
                                        <button type="button" onclick="decrementar(this)"
                                            class="bg-gray-700 hover:bg-gray-600 text-white px-2 py-1.5 text-base font-bold transition-colors">−</button>
                                        <input type="number" name="cantidad" value="{{ $item['cantidad'] }}"
                                            min="1" max="{{ $item['existencia'] }}"
                                            class="w-12 text-center bg-gray-800 text-white border-0 py-2 text-sm font-medium focus:outline-none focus:ring-0 cantidad-input">
                                        <button type="button" onclick="incrementar(this)"
                                            class="bg-gray-700 hover:bg-gray-600 text-white px-3 py-2 text-base font-bold transition-colors">+</button>
                                    </div>
                                    <button type="submit"
                                        class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-3 py-2 rounded-lg transition-colors">
                                        ✓
                                    </button>
                                </form>

                                {{-- Eliminar --}}
                                <form action="{{ route('carrito.eliminar') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id_herramienta" value="{{ $item['id_herramienta'] }}">
                                    <button type="submit"
                                        class="text-red-400 hover:text-red-300 text-xs flex items-center gap-1 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Resumen --}}
                <div class="lg:col-span-1">
                    <div class="bg-[#023047] rounded-xl border border-gray-600 p-6 sticky top-6">
                        <h2 class="text-white font-bold text-lg mb-4">Resumen</h2>

                        <div class="space-y-2 mb-4">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-400">Herramientas distintas</span>
                                <span class="text-white font-semibold">{{ count($carrito) }}</span>
                            </div>
                            <div class="border-t border-gray-600 pt-3 flex justify-between">
                                <span class="text-white font-semibold">Total unidades</span>
                                <span class="text-orange-400 font-bold text-xl">{{ $totalUnidades }}</span>
                            </div>
                        </div>

                        {{-- Vaciar carrito --}}
                        <form action="{{ route('carrito.vaciar') }}" method="POST" class="mt-4">
                            @csrf
                            <button type="submit" onclick="return confirm('¿Estás seguro de vaciar el carrito?')"
                                class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-2.5 rounded-xl transition-colors flex items-center justify-center gap-2 text-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Vaciar carrito
                            </button>
                        </form>

                        <a href="{{ route('herramientas.index') }}"
                            class="mt-3 text-center text-gray-400 hover:text-white text-sm transition-colors block">
                            ← Seguir explorando
                        </a>
                    </div>
                </div>

            </div>
        @endif
    </div>

    <script>
        function decrementar(btn) {
            const input = btn.nextElementSibling;
            input.value = Math.max(1, parseInt(input.value) - 1);
        }

        function incrementar(btn) {
            const input = btn.previousElementSibling;
            const max = parseInt(input.getAttribute('max')) || 9999;
            input.value = Math.min(max, parseInt(input.value) + 1);
        }
    </script>

@endsection

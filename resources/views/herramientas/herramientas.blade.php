@extends('plantilla.app')

@section('titulo', 'herramientas')


@section('contenido')
    <!-- PRODUCTOS -->
    <div class="max-w-6xl mx-auto px-6 mt-5">

        <div class="bg-[#023047] rounded-2xl p-5 border border-gray-700 shadow-lg">
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-bold text-white">Herramientas</h1>
                <div class="flex items-center gap-3">
                    <button onclick="openDrawer()"
                        class="flex items-center gap-2 bg-gray-800 hover:bg-gray-700 border border-gray-600 text-white text-sm font-medium px-4 py-2 rounded-lg transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z" />
                        </svg>
                        Filters
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <button
                        class="flex items-center gap-2 bg-gray-800 hover:bg-gray-700 border border-gray-600 text-white text-sm font-medium px-4 py-2 rounded-lg transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 7h18M6 12h12m-4 5h4" />
                        </svg>
                        Sort
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

                @foreach ($herramientas as $herramienta)
                    <div
                        class="bg-[#023047] rounded-xl border border-gray-500 overflow-hidden hover:border-orange-600 transition-colors flex flex-col sjadow-lg duration-400">

                        <!-- Imagen -->
                        <div class="bg-white flex items-center justify-center h-56 p-4">
                            <img class="h-44 object-contain" src="{{ config('app.api_url') . $herramienta->imagen }}"
                                alt="{{ $herramienta->nombre_herramienta }}">
                        </div>

                        <!-- Contenido -->
                        <div class="p-4 flex flex-col flex-1">

                            <p class="text-orange-400 text-xs font-bold tracking-widest mb-1">
                                {{ $herramienta->categoria->nombre_categoria }}
                            </p>

                            <h3 class="text-white text-sm font-semibold leading-snug mb-2">
                                {{ $herramienta->nombre_herramienta }}
                            </h3>

                            <div class="flex items-center gap-1 mb-3">
                                <span class="text-gray-400 text-xs">Existencia:</span>
                                <span class="text-white text-xs font-semibold">{{ $herramienta->existencia }}</span>
                            </div>

                            {{-- <div class="flex gap-2 mb-2 mt-auto">
                                    <button
                                        class="flex-1 text-xs border border-gray-600 text-gray-300 hover:text-white hover:border-gray-400 py-1.5 rounded-lg transition-colors">
                                        Wishlist
                                    </button>
                                    <button
                                        class="flex-1 text-xs border border-gray-600 text-gray-300 hover:text-white hover:border-gray-400 py-1.5 rounded-lg transition-colors">
                                        Compare
                                    </button>
                                </div> --}}

                            <a href="{{ route('herramientas.show', $herramienta->id_herramienta) }}"
                                class="w-full bg-orange-500 hover:bg-orange-600 text-white text-xs font-semibold py-2 rounded-lg transition-colors flex items-center justify-center gap-2">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                Ver producto
                            </a>

                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>

    <!-- PAGINACIÓN -->
    <div class="mt-10">

        {{-- {{ $herramientas->links() }} --}}

    </div>

    </div>
@endsection

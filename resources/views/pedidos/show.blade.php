@extends('plantilla.app')

@section('titulo', 'Detalle del pedido #' . $pedido['id_prestamo'])

@section('contenido')

    <div class="max-w-4xl mx-auto px-6 py-10">

        {{-- Alertas --}}
        @if (session('success'))
            <div id="alerta-success"
                class="mb-5 bg-green-500 text-white px-4 py-3 rounded-lg flex items-center gap-2 text-sm">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                {{ session('success') }}
            </div>
            <script>
                setTimeout(() => document.getElementById('alerta-success')?.remove(), 5000)
            </script>
        @endif

        @if (session('error'))
            <div class="mb-5 bg-red-500 text-white px-4 py-3 rounded-lg flex items-center gap-2 text-sm">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
                {{ session('error') }}
            </div>
        @endif

        {{-- Encabezado --}}
        <div class="flex items-center justify-between mb-6 flex-wrap gap-3">
            <h1 class="text-2xl font-bold text-orange-400 flex items-center gap-3">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2" />
                </svg>
                Pedido #{{ $pedido['id_prestamo'] }}
            </h1>
            <a href="{{ route('pedidos.index') }}" class="text-gray-400 hover:text-white text-sm transition-colors">
                ← Volver a mis pedidos
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Detalles de herramientas --}}
            <div class="lg:col-span-2 space-y-3">
                <h2 class="text-white font-semibold text-base mb-3">Herramientas solicitadas</h2>

                @forelse ($pedido['detalles'] as $detalle)
                    @php
                        $herramienta = $detalle['herramienta'] ?? null;
                        $colorArticulo = match ($detalle['estatus_articulo'] ?? '') {
                            'Prestado' => 'text-blue-400',
                            'Devuelto' => 'text-green-400',
                            'Perdido' => 'text-red-400',
                            'Dañado' => 'text-yellow-400',
                            'Consumido' => 'text-gray-400',
                            default => 'text-gray-400',
                        };
                    @endphp

                    <div class="bg-[#023047] rounded-xl border border-gray-600 p-4 flex items-center gap-4">
                        {{-- Imagen --}}
                        @if ($herramienta && $herramienta['imagen'])
                            <div class="bg-white rounded-lg p-2 shrink-0 w-16 h-16 flex items-center justify-center">
                                <img src="{{ config('app.api_url') . $herramienta['imagen'] }}"
                                    alt="{{ $herramienta['nombre_herramienta'] ?? '' }}" class="h-12 w-12 object-contain">
                            </div>
                        @else
                            <div class="bg-gray-700 rounded-lg w-16 h-16 flex items-center justify-center shrink-0">
                                <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif

                        {{-- Info --}}
                        <div class="flex-1 min-w-0">
                            <p class="text-white font-semibold text-sm">
                                {{ $herramienta['nombre_herramienta'] ?? 'Herramienta #' . $detalle['id_herramienta'] }}
                            </p>
                            <p class="text-gray-400 text-xs mt-1">
                                Cantidad: <span class="text-orange-400 font-bold">{{ $detalle['cantidad'] }}</span>
                            </p>
                            {{-- <p class="text-gray-400 text-xs mt-0.5">
                                Estado: <span
                                    class="{{ $colorArticulo }} font-semibold">{{ $detalle['estatus_articulo'] }}</span>
                            </p> --}}
                        </div>

                        {{-- Subtotal --}}
                        <div class="text-right shrink-0">
                            <p class="text-gray-400 text-xs">Subtotal</p>
                            <p class="text-white font-bold">${{ number_format($detalle['subtotal'] ?? 0, 2) }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-400 text-sm">Sin detalles disponibles.</p>
                @endforelse
            </div>

            {{-- Resumen del pedido --}}
            <div class="lg:col-span-1">
                <div class="bg-[#023047] rounded-xl border border-gray-600 p-6 sticky top-6">
                    <h2 class="text-white font-bold text-lg mb-4">Resumen</h2>

                    @php
                        $estatus = $pedido['estatus_general'];
                        $colorEstatus = match ($estatus) {
                            'Activo' => 'bg-green-500/20 text-green-400 border border-green-500/30',
                            'Devuelto Parcial' => 'bg-yellow-500/20 text-yellow-400 border border-yellow-500/30',
                            'Cerrado' => 'bg-gray-500/20 text-gray-400 border border-gray-500/30',
                            default => 'bg-gray-500/20 text-gray-400 border border-gray-500/30',
                        };
                    @endphp

                    <div class="space-y-3 text-sm mb-5">
                        <div class="flex justify-between">
                            <span class="text-gray-400">Número de pedido</span>
                            <span class="text-white font-semibold">#{{ $pedido['id_prestamo'] }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400">Fecha</span>
                            <span class="text-white">
                                {{ \Carbon\Carbon::parse($pedido['fecha_prestamo'])->format('d/m/Y H:i') }}
                            </span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-400">Estado</span>
                            <span class="text-xs font-semibold px-3 py-1 rounded-full {{ $colorEstatus }}">
                                {{ $estatus }}
                            </span>
                        </div>
                        {{-- <div class="flex justify-between">
                            <span class="text-gray-400">Artículos</span>
                            <span class="text-white font-semibold">{{ count($pedido['detalles']) }}</span>
                        </div> --}}
                        <div class="border-t border-gray-600 pt-3 flex justify-between">
                            <span class="text-white font-semibold">Total</span>
                            <span class="text-orange-400 font-bold text-xl">
                                ${{ number_format($pedido['total'] ?? 0, 2) }}
                            </span>
                        </div>
                    </div>

                    {{-- Botón cancelar --}}
                    @if ($estatus !== 'Cerrado')
                        <form action="{{ route('pedidos.cancelar', $pedido['id_prestamo']) }}" method="POST"
                            onsubmit="return confirm('¿Estás seguro de cancelar este pedido? Las herramientas regresarán al inventario.')">
                            @csrf
                            <button type="submit"
                                class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-2.5 rounded-xl transition-colors flex items-center justify-center gap-2 text-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Cancelar pedido
                            </button>
                        </form>
                    @else
                        <div class="w-full bg-gray-700 text-gray-400 font-semibold py-2.5 rounded-xl text-sm text-center">
                            Pedido cerrado
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>

@endsection

@extends('plantilla.app')

@section('titulo', 'Mis pedidos')

@section('contenido')

    <div class="max-w-5xl mx-auto px-6 py-10">

        <h1 class="text-2xl font-bold text-orange-400 mb-6 flex items-center gap-3">
            <svg class="w-7 h-7 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
            </svg>
            Mis pedidos
        </h1>

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

        @if (session('error') || $errorApi)
            <div class="mb-5 bg-red-500 text-white px-4 py-3 rounded-lg flex items-center gap-2 text-sm">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
                {{ session('error') ?? $errorApi }}
            </div>
        @endif

        @if (empty($pedidos))
            <div class="bg-[#023047] rounded-2xl border border-gray-600 p-16 text-center">
                <svg class="w-20 h-20 text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                <p class="text-gray-400 text-lg mb-6">Aún no tienes pedidos</p>
                <a href="{{ route('herramientas.index') }}"
                    class="bg-orange-500 hover:bg-orange-600 text-white font-semibold px-6 py-3 rounded-xl transition-colors inline-block">
                    Ver catálogo
                </a>
            </div>
        @else
            <div class="space-y-3">
                @foreach ($pedidos as $pedido)
                    @php
                        $estatus = $pedido['estatus_general'];
                        $colorEstatus = match ($estatus) {
                            'Activo' => 'bg-green-500/20 text-green-400 border border-green-500/30',
                            'Devuelto Parcial' => 'bg-yellow-500/20 text-yellow-400 border border-yellow-500/30',
                            'Cerrado' => 'bg-gray-500/20 text-gray-400 border border-gray-500/30',
                            default => 'bg-gray-500/20 text-gray-400 border border-gray-500/30',
                        };
                    @endphp

                    <div
                        class="bg-[#023047] rounded-xl border border-gray-600 p-4 hover:border-orange-500 transition-colors">
                        <div class="flex items-center justify-between flex-wrap gap-3">

                            {{-- Info principal --}}
                            <div class="flex items-center gap-4">
                                <div class="bg-orange-500/10 border border-orange-500/20 rounded-lg p-2.5">
                                    <svg class="w-5 h-5 text-orange-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-white font-semibold text-sm">Pedido #{{ $pedido['id_prestamo'] }}</p>
                                    <p class="text-gray-400 text-xs mt-0.5">
                                        {{ \Carbon\Carbon::parse($pedido['fecha_prestamo'])->format('d/m/Y H:i') }}
                                    </p>
                                </div>
                            </div>

                            {{-- Estatus y total --}}
                            <div class="flex items-center gap-4">
                                <div class="text-right">
                                    <p class="text-gray-400 text-xs">Total</p>
                                    <p class="text-orange-400 font-bold">
                                        ${{ number_format($pedido['total'] ?? 0, 2) }}
                                    </p>
                                </div>
                                <span class="text-xs font-semibold px-3 py-1 rounded-full {{ $colorEstatus }}">
                                    {{ $estatus }}
                                </span>
                                <a href="{{ route('pedidos.show', $pedido['id_prestamo']) }}"
                                    class="bg-gray-700 hover:bg-gray-600 text-white text-xs px-3 py-2 rounded-lg transition-colors">
                                    Ver detalle →
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

@endsection

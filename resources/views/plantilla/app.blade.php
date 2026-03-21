<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Herramientas - @yield('titulo')</title>
    @vite('resources/css/app.css', 'resources/js/app.js')
</head>

<body class="min-h-screen flex flex-col">

    @php
        $currentRoute = request()->route()->getName();
        $isLoginPage =
            $currentRoute === 'login' || $currentRoute === 'registro' || $currentRoute === 'aviso.privacidad';
        $isRegistroPage = $currentRoute === 'registro';
        $isAvisoPage = $currentRoute === 'aviso.privacidad';
    @endphp

    <header class="antialiased">
        <nav class="bg-white border-gray-200 px-4 lg:px-6 py-2.5 dark:bg-[#023047]">
            <div class="flex flex-wrap justify-between items-center">

                <div class="flex justify-start items-center">

                    <a href="{{ route('herramientas.index') }}" class="flex mr-4">
                        <span
                            class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Herramientas</span>
                    </a>
                </div>

                {{-- Lado derecho: acciones de usuario --}}
                @if (!$isLoginPage)
                    <div class="flex items-center gap-2 lg:order-2">

                        <ul>
                            <li class="relative">
                                <button id="dropdownHerramientasButton" data-dropdown-toggle="dropdownHerramientas"
                                    data-dropdown-placement="bottom"
                                    class="flex items-center justify-between w-full py-2 px-3 rounded font-medium text-white md:w-auto
                            hover:bg-orange-500 md:hover:bg-transparent md:border-0 md:hover:text-orange-500 md:p-0 duration-200">
                                    Herramientas
                                    <svg class="w-4 h-4 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m19 9-7 7-7-7" />
                                    </svg>
                                </button>
                                <!-- Dropdown menu -->
                                <div id="dropdownHerramientas"
                                    class="z-10 absolute hidden bg-neutral-primary-medium border border-default-medium rounded-base shadow-lg w-44">
                                    <ul class="p-2 text-sm text-body font-medium"
                                        aria-labelledby="dropdownHerramientasButton">
                                        <li>
                                            <a href="/herramientas/registro"
                                                class="block w-full p-2 hover:bg-orange-300 hover:text-heading rounded transition-colors duration-300">Registro</a>
                                        </li>
                                        <li>
                                            <a href="/herramientas/listado"
                                                class="block w-full p-2 hover:bg-orange-300 hover:text-heading rounded transition-colors duration-300">Listado</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>

                        {{-- Botón solicitar herramienta --}}
                        <button type="button"
                            class="hidden sm:inline-flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-xs px-3 py-1.5 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                            <svg aria-hidden="true" class="mr-1 -ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <a href="/herramientas">Solicitar Herramienta</a>
                        </button>

                        {{-- Icono del carrito --}}
                        <a href="{{ route('carrito.index') }}"
                            class="relative p-2 text-white hover:text-orange-400 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            @php $cantidadCarrito = count(session('carrito', [])); @endphp
                            @if ($cantidadCarrito > 0)
                                <span
                                    class="absolute -top-1 -right-1 bg-orange-500 text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center">
                                    {{ $cantidadCarrito }}
                                </span>
                            @endif
                        </a>

                        <a href="{{ route('pedidos.index') }}"
                            class="relative flex items-center gap-1.5 py-2 px-3 rounded font-medium text-white
                                   hover:bg-orange-500 md:hover:bg-transparent md:hover:text-orange-400
                                   transition-colors duration-200 text-sm
                                   {{ str_starts_with($currentRoute, 'pedidos') ? 'text-orange-400' : '' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2
                                       M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            Mis pedidos
                        </a>

                        {{-- Usuario activo --}}
                        @if (session('api_token'))
                            <div class="relative">
                                <button type="button"
                                    class="flex text-sm rounded-full focus:ring-4 focus:ring-orange-300 hover:ring-2 hover:ring-orange-400 transition-all"
                                    id="user_foto" data-dropdown-toggle="user_informacion"
                                    data-dropdown-placement="bottom">
                                    @if (!empty(session('usuario')['imagen']))
                                        <img class="w-8 h-8 rounded-full object-cover border-2 border-orange-400"
                                            src="http://localhost:8000/storage/{{ session('usuario')['imagen'] }}"
                                            alt="Avatar">
                                    @else
                                        <div
                                            class="w-8 h-8 rounded-full bg-orange-500 flex items-center justify-center text-white font-bold text-sm border-2 border-orange-400">
                                            {{ strtoupper(substr(session('usuario')['name'], 0, 1)) }}
                                        </div>
                                    @endif
                                </button>

                                <div id="user_informacion"
                                    class="z-50 hidden bg-white border border-gray-200 rounded-lg shadow-lg w-56 absolute right-0 top-10">
                                    <div class="px-4 py-3 text-sm">
                                        <span
                                            class="block font-semibold text-gray-900">{{ session('usuario')['name'] }}</span>
                                        <span
                                            class="block text-gray-500 truncate text-xs mt-1">{{ session('usuario')['email'] }}</span>
                                    </div>
                                    <ul class="py-2 border-t border-gray-100">
                                        <li>
                                            <a href="{{ route('perfil.index') }}"
                                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-500">
                                                Mi perfil
                                            </a>
                                        </li>
                                        <li>
                                            <form action="{{ route('logout') }}" method="POST">
                                                @csrf
                                                <button type="submit"
                                                    class="w-full text-left px-4 py-2 text-sm text-red-500 hover:bg-red-50">
                                                    Cerrar sesión
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @endif


                    </div>

                    @if ($isRegistroPage || $isAvisoPage)
                        <a href="{{ route('login') }}"
                            class="ml-2 text-gray-500 hover:text-[#fb5607] dark:text-gray-400 dark:hover:text-[#fb5607]">
                            Iniciar sesión
                        </a>
                    @endif

                @endif

            </div>
        </nav>
    </header>

    <div class="flex-1">
        @yield('contenido')
    </div>

    <footer class="p-4 bg-white md:p-8 lg:p-10 dark:bg-[#023047]">
        <div class="mx-auto max-w-screen-xl text-center">
            <a href="#"
                class="flex justify-center items-center text-2xl font-semibold text-gray-900 dark:text-white">
                <img src="{{ asset('storage/img/logo_herramientas.png') }}" alt="logo" class="h-15 w-auto mr-2">
                Herramientas
            </a>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>

</body>

</html>

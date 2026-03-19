<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Herramientas - @yield('titulo')</title>
    @vite('resources/css/app.css', 'resources/js/app.js')
</head>

<body>

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

                {{-- Lado izquierdo: toggle sidebar + logo + buscador --}}
                <div class="flex justify-start items-center">
                    <button id="toggleSidebar" aria-expanded="true" aria-controls="sidebar"
                        class="hidden p-2 mr-3 text-gray-600 rounded cursor-pointer lg:inline hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-700">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 16 12">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 1h14M1 6h14M1 11h7" />
                        </svg>
                    </button>

                    <button aria-expanded="true" aria-controls="sidebar"
                        class="p-2 mr-2 text-gray-600 rounded-lg cursor-pointer lg:hidden hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                        <svg class="w-[18px] h-[18px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 17 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 1h15M1 7h15M1 13h15" />
                        </svg>
                        <span class="sr-only">Toggle sidebar</span>
                    </button>

                    <a href="{{ route('herramientas.index') }}" class="flex mr-4">
                        <span
                            class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Herramientas</span>
                    </a>

                    @if (!$isLoginPage)
                        <form action="#" method="GET" class="hidden lg:block lg:pl-2">
                            <label for="topbar-search" class="sr-only">Buscar herramientas</label>
                            <div class="relative mt-1 lg:w-96">
                                <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                    </svg>
                                </div>
                                <input type="text" name="q" id="topbar-search"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-9 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                    placeholder="Buscar herramientas">
                            </div>
                        </form>
                    @endif
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

    <div>
        @yield('contenido')
    </div>

    <footer class="p-4 bg-white md:p-8 lg:p-10 dark:bg-[#023047]">
        <div class="mx-auto max-w-screen-xl text-center">
            <a href="#"
                class="flex justify-center items-center text-2xl font-semibold text-gray-900 dark:text-white">
                <img src="{{ asset('storage/img/logo_herramientas.png') }}" alt="logo" class="h-15 w-auto mr-2">
                Herramientas
            </a>
            <p class="my-6 text-gray-500 dark:text-gray-400"></p>
            <ul class="flex flex-wrap justify-center items-center mb-6 text-gray-900 dark:text-white">
                <li>
                    <a href="{{ route('aviso.privacidad') }}" class="mr-4 hover:underline md:mr-6">Aviso de
                        privacidad</a>
                </li>
            </ul>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>

</body>

</html>

@extends('plantilla.app')

@section('titulo', 'Aviso de Privacidad')

@section('contenido')

    <section class="min-h-screen bg-[#f0f0f0] py-10 px-4">
        <div class="max-w-3xl mx-auto">

            {{-- Encabezado --}}
            <div class="mb-8">
                <p class="text-sm font-semibold uppercase tracking-widest text-gray-500 mb-3">Electric's Component</p>
                <h1 class="text-5xl font-black uppercase leading-tight text-gray-900">
                    Aviso de<br>Privacidad.
                </h1>
                <div class="mt-4 h-0.5 w-16 bg-gray-900"></div>
            </div>

            <p class="text-gray-600 text-lg leading-relaxed mb-8">
                Electric's Component, con domicilio para efectos académicos, es responsable del uso y
                protección de sus datos personales, y al respecto le informamos lo siguiente:
            </p>

            {{-- Secciones --}}
            <div class="space-y-8">

                <div class="border-t border-gray-300 pt-6">
                    <h2 class="text-2xl font-black uppercase text-gray-900 mb-4">
                        1. Finalidad del tratamiento de los datos personales.
                    </h2>
                    <p class="text-gray-600 leading-relaxed mb-3">
                        Recolectaremos información concerniente a tu persona dentro de la plataforma.
                        Las finalidades para las cuales utilizamos esta información son:
                    </p>
                    <ul class="space-y-2 text-gray-600">
                        <li class="flex gap-3">
                            <span class="font-bold text-gray-900 shrink-0">1.1</span>
                            Administración de usuarios dentro de la plataforma web desarrollada en PHP con el framework
                            Laravel.
                        </li>
                        <li class="flex gap-3">
                            <span class="font-bold text-gray-900 shrink-0">1.2</span>
                            Gestión de servicios, procesos internos y control administrativo.
                        </li>
                        <li class="flex gap-3">
                            <span class="font-bold text-gray-900 shrink-0">1.3</span>
                            Autenticación, autorización y control de accesos al sistema.
                        </li>
                        <li class="flex gap-3">
                            <span class="font-bold text-gray-900 shrink-0">1.4</span>
                            Registro de actividades dentro de la plataforma.
                        </li>
                    </ul>
                </div>

                <div class="border-t border-gray-300 pt-6">
                    <h2 class="text-2xl font-black uppercase text-gray-900 mb-4">
                        2. Datos personales recabados.
                    </h2>
                    <p class="text-gray-600 leading-relaxed mb-3">
                        Para llevar a cabo las finalidades descritas, utilizaremos los siguientes datos personales:
                    </p>
                    <ul class="space-y-2 text-gray-600">
                        <li class="flex gap-3">
                            <span class="font-bold text-gray-900 shrink-0">2.1</span>
                            Nombre del usuario.
                        </li>
                        <li class="flex gap-3">
                            <span class="font-bold text-gray-900 shrink-0">2.2</span>
                            Correo electrónico.
                        </li>
                        <li class="flex gap-3">
                            <span class="font-bold text-gray-900 shrink-0">2.3</span>
                            Rol o perfil dentro del sistema.
                        </li>
                        <li class="flex gap-3">
                            <span class="font-bold text-gray-900 shrink-0">2.4</span>
                            Credenciales de acceso.
                        </li>
                    </ul>
                </div>

                <div class="border-t border-gray-300 pt-6">
                    <h2 class="text-2xl font-black uppercase text-gray-900 mb-4">
                        3. Protección de datos personales.
                    </h2>
                    <p class="text-gray-600 leading-relaxed">
                        Electric's Component implementa medidas de seguridad administrativas, técnicas y físicas
                        para proteger los datos personales, haciendo uso de mecanismos propios del framework
                        Laravel para prevenir accesos no autorizados, pérdida, alteración o uso indebido de
                        la información.
                    </p>
                </div>

                <div class="border-t border-gray-300 pt-6">
                    <h2 class="text-2xl font-black uppercase text-gray-900 mb-4">
                        4. Transferencia de datos personales.
                    </h2>
                    <p class="text-gray-600 leading-relaxed">
                        Los datos personales no serán compartidos con terceros. La información es utilizada
                        exclusivamente con fines académicos y de desarrollo del proyecto.
                    </p>
                </div>

                <div class="border-t border-gray-300 pt-6">
                    <h2 class="text-2xl font-black uppercase text-gray-900 mb-4">
                        5. Derechos ARCO.
                    </h2>
                    <p class="text-gray-600 leading-relaxed">
                        El titular de los datos personales podrá ejercer sus derechos de Acceso, Rectificación,
                        Cancelación u Oposición (ARCO) mediante solicitud directa al administrador del sistema.
                    </p>
                </div>

                <div class="border-t border-gray-300 pt-6">
                    <h2 class="text-2xl font-black uppercase text-gray-900 mb-4">
                        6. Uso académico.
                    </h2>
                    <p class="text-gray-600 leading-relaxed">
                        El presente Aviso de Privacidad forma parte de un proyecto académico y no representa
                        una solución comercial real.
                    </p>
                </div>

                <div class="border-t border-gray-300 pt-6">
                    <h2 class="text-2xl font-black uppercase text-gray-900 mb-4">
                        7. Aceptación del aviso de privacidad.
                    </h2>
                    <p class="text-gray-600 leading-relaxed">
                        El uso de la plataforma Electric's Component implica la aceptación del presente
                        Aviso de Privacidad.
                    </p>
                </div>

            </div>

            {{-- Botón descargar PDF --}}
            <div class="mt-10 pt-6 border-t border-gray-300 flex justify-end">
                <a href="{{ route('aviso.privacidad.pdf') }}"
                    class="inline-flex items-center gap-2 px-6 py-3 bg-gray-900 hover:bg-gray-700 text-white font-semibold rounded-lg transition-colors duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                    Descargar PDF
                </a>
            </div>

        </div>
    </section>


@endsection

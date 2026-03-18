<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 13px;
            color: #1a202c;
            padding: 40px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
        }

        .header h1 {
            font-size: 24px;
            color: #023047;
            margin-bottom: 8px;
        }

        .header p {
            font-size: 12px;
            color: #666;
        }

        .section {
            margin-bottom: 20px;
        }

        .section h2 {
            font-size: 14px;
            color: #023047;
            font-weight: bold;
            margin-bottom: 8px;
            border-left: 4px solid #fb5607;
            padding-left: 8px;
        }

        .section p,
        .section ul {
            font-size: 12px;
            color: #4a5568;
            line-height: 1.7;
        }

        .section ul {
            padding-left: 20px;
        }

        .section ul li {
            margin-bottom: 4px;
        }

        .footer {
            margin-top: 40px;
            border-top: 1px solid #e2e8f0;
            padding-top: 15px;
            text-align: center;
            font-size: 11px;
            color: #999;
        }
    </style>
</head>

<body>

    <div class="header">
        <h1>Aviso de Privacidad</h1>
        <p>Electric's Component — Proyecto académico</p>
    </div>

    <div class="section">
        <p>Electric's Component, con domicilio para efectos académicos, es responsable del uso y protección
            de sus datos personales, y al respecto le informamos lo siguiente:</p>
    </div>

    <div class="section">
        <h2>Finalidad del tratamiento de los datos personales</h2>
        <ul>
            <li>Administración de usuarios dentro de la plataforma web desarrollada en PHP con el framework Laravel.
            </li>
            <li>Gestión de servicios, procesos internos y control administrativo.</li>
            <li>Autenticación, autorización y control de accesos al sistema.</li>
            <li>Registro de actividades dentro de la plataforma.</li>
        </ul>
    </div>

    <div class="section">
        <h2>Datos personales recabados</h2>
        <ul>
            <li>Nombre del usuario</li>
            <li>Correo electrónico</li>
            <li>Rol o perfil dentro del sistema</li>
            <li>Credenciales de acceso</li>
        </ul>
    </div>

    <div class="section">
        <h2>Protección de datos personales</h2>
        <p>Electric's Component implementa medidas de seguridad administrativas, técnicas y físicas para proteger
            los datos personales, haciendo uso de mecanismos propios del framework Laravel para prevenir accesos
            no autorizados, pérdida, alteración o uso indebido de la información.</p>
    </div>

    <div class="section">
        <h2>Transferencia de datos personales</h2>
        <p>Los datos personales no serán compartidos con terceros. La información es utilizada exclusivamente
            con fines académicos y de desarrollo del proyecto.</p>
    </div>

    <div class="section">
        <h2>Derechos ARCO</h2>
        <p>El titular de los datos personales podrá ejercer sus derechos de Acceso, Rectificación, Cancelación
            u Oposición (ARCO) mediante solicitud directa al administrador del sistema.</p>
    </div>

    <div class="section">
        <h2>Uso académico</h2>
        <p>El presente Aviso de Privacidad forma parte de un proyecto académico y no representa una solución
            comercial real.</p>
    </div>

    <div class="section">
        <h2>Aceptación del aviso de privacidad</h2>
        <p>El uso de la plataforma Electric's Component implica la aceptación del presente Aviso de Privacidad.</p>
    </div>

    <div class="footer">
        <p>Electric's Component &copy; {{ date('Y') }}</p>
    </div>

</body>

</html>

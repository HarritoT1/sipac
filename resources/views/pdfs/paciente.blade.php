<!DOCTYPE html>
<html lang="es">

@php
    $obj = (object) [
        'nombre' => 'Juan Pérez',
        'curp' => 'PEPJ800101HDFRRL09',
        'correo' => 'juan.perez@example.com',
        'telefono' => '555-123-4567',
        'direccion' => 'Calle Falsa 123, Ciudad de México',
        'nacimiento' => '1980-01-01',
        'genero' => 'Masculino',
        'is_active' => 'Sí',
    ];
@endphp

<head>
    <meta charset="UTF-8">
    <title>Cita</title>

    <style>
        @page {
            margin: 30px 35px;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333333;
            margin: 0;
            padding: 0;
        }

        h1 {
            color: #7F1D1D;
            font-size: 25px;
            margin: 18px 0;
        }

        h2 {
            color: #7F1D1D;
            font-size: 18px;
            margin: 0 0 12px 0;
        }

        p {
            margin: 0 0 10px 0;
            line-height: 1.5;
        }

        .borders td,
        th {
            border: 1px solid #dddddd;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }

        .header {
            width: 100%;
            text-align: center;
            padding-bottom: 15px;
        }

        .logo-table {
            width: 100%;
            border-collapse: collapse;
        }

        .logo-table td {
            width: 25%;
            text-align: center;
            vertical-align: middle;
        }

        .logo {
            max-width: 180px;
            height: 100px;
        }

        .separator {
            height: 15px;
            background-color: #7F1D1D;
            margin: 15px 0;
        }

        .details-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .details-table td {
            vertical-align: center;
        }

        .information {
            width: 60%;
            padding: 15px;
            border-right: 2px solid #7F1D1D;
        }

        .profile {
            width: 40%;
            padding: 15px;
            text-align: center;
        }

        .field-label {
            color: #7F1D1D;
            font-weight: bold;
        }

        .profile-image {
            width: 135px;
            height: 135px;
            border: 3px solid #E5B567;
        }

        .tag {
            padding: 9px;
            margin-top: 12px;
            font-weight: bold;
            text-align: center;
        }

        .tag-gold {
            background-color: #FFF3D6;
            color: #8A5A00;
            border: 1px solid #E5B567;
        }

        .tag-red {
            background-color: #F8E7E7;
            color: #7F1D1D;
            border: 1px solid #D8A0A0;
        }

        .section-box {
            border: 1px solid #D6B6B6;
            padding: 18px;
            margin-top: 12px;
        }

        .section-heading {
            font-size: 17px;
            font-weight: bold;
            color: #7F1D1D;
            margin-bottom: 12px;
        }

        .reason {
            background-color: #FAF7F2;
            line-height: 1.7;
            text-align: justify;
        }

        .professional {
            width: 65%;
            margin: 0 auto;
            text-align: center;
            padding: 15px;
        }

        .professional-image {
            width: 130px;
            height: 130px;
            border: 3px solid #E5B567;
        }

        .notice {
            background-color: #FAF7F2;
            border: 1px solid #D6B6B6;
            padding: 18px;
            line-height: 1.7;
        }

        .notice ul {
            padding-left: 20px;
            margin-bottom: 0;
        }

        .notice li {
            margin-bottom: 8px;
        }

        .footer {
            margin: 30px 0;
            border-top: 1px solid #D6B6B6;
            padding-top: 10px;
            text-align: center;
            color: #777777;
            font-size: 15px;
        }

        .keep-together {
            page-break-inside: avoid;
        }
    </style>
</head>

<body>

    <!-- Encabezado institucional -->
    <div class="header">
        <table class="logo-table">
            <tr>
                <td>
                    <img src="{{ asset('img/cdmx.jpeg') }}" alt="Logo CDMX" class="logo">
                </td>
                <td>
                    <img src="{{ asset('img/logo_tlahuac.svg') }}" alt="Logo Tláhuac" class="logo">
                </td>
                <td>
                    <!-- Es preferible utilizar PNG si el SVG no se renderiza -->
                    <img src="{{ asset('img/tlahuac.jpeg') }}" alt="Logo de la alcaldía" class="logo">
                </td>
                <td>
                    <!-- Es preferible utilizar PNG si el SVG no se renderiza -->
                    <img src="{{ asset('img/2026.jpeg') }}" alt="Logo de la alcaldía" class="logo">
                </td>
            </tr>
        </table>
    </div>

    <div class="separator"></div>

    <!-- Información de la cita -->
    <h1>Reporte del paciente:</h1>

    <table class="details-table">
        <tr>
            <td class="information">
                <p>
                    <span class="field-label">Nombre del paciente:</span><br>
                    {{ $obj->nombre }}
                </p>

                <p>
                    <span class="field-label">CURP:</span><br>
                    {{ $obj->curp }}
                </p>

                <p>
                    <span class="field-label">Correo electrónico:</span><br>
                    {{ $obj->correo }}
                </p>

                <p>
                    <span class="field-label">Teléfono:</span><br>
                    {{ $obj->telefono }}
                </p>

                <p>
                    <span class="field-label">Dirección:</span><br>
                    {{ $obj->direccion }}
                </p>

                <p>
                    <span class="field-label">Nacimiento:</span><br>
                    {{ $obj->nacimiento }}
                </p>

                <p>
                    <span class="field-label">Género:</span><br>
                    {{ $obj->genero }}
                </p>
            </td>

            <td class="profile">
                <img src="perfil.jpg" alt="Fotografía del paciente" class="profile-image">

                <div class="tag tag-gold">
                    Estado activo: {{ $obj->is_active }}
                </div>

            </td>
        </tr>
    </table>

    <div class="separator"></div>

    <!-- Indicaciones importantes -->
    <div class="notice">
        <div class="section-heading">Contactos de emergencia:</div>

        <table class="logo-table borders">
            <tr>
                <th>Nombre</th>
                <th>Relación</th>
                <th>Teléfono</th>
                <th>Correo electrónico</th>
                <th>Es principal</th>
            </tr>
            <tr>
                <td style="width: 20%; text-align: center;">Hugo Martínez</td>
                <td style="width: 20%; text-align: center;">Padre</td>
                <td style="width: 20%; text-align: center;">55-1234-5678</td>
                <td style="width: 20%; text-align: center;">hugo.martinez@email.com</td>
                <td style="width: 20%; text-align: center;">Sí</td>
            </tr>
            <tr>
                <td style="width: 20%; text-align: center;">María López</td>
                <td style="width: 20%; text-align: center;">Madre</td>
                <td style="width: 20%; text-align: center;">55-8765-4321</td>
                <td style="width: 20%; text-align: center;">maria.lopez@email.com</td>
                <td style="width: 20%; text-align: center;">No</td>
            </tr>
        </table>
    </div>

    <div class="separator"></div>

    <br>
    <h2>Historial de terapias (sesiones) de las citas:</h2>

    <table class="logo-table borders" style="margin-bottom: 20px;">
        <h2>Sesión #1</h2>
        <tr>
            <td style="width: 50%; text-align: justify;">
                <div class="section-heading">Diagnóstico principal</div>
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Suscipit, explicabo. At cumque mollitia, natus
                nulla magnam deleniti, rem incidunt earum aliquid impedit nobis accusamus nostrum expedita. Aliquid quos
                cupiditate eos! Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam, accusantium?
                Exercitationem nisi, quasi temporibus voluptate, hic architecto harum consectetur porro consequuntur
                excepturi, aperiam numquam deleniti illo ullam laborum magni praesentium!
            </td>
            <td style="width: 50%; text-align: justify;">
                <div class="section-heading">Historial clínico</div>
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Suscipit, explicabo. At cumque mollitia, natus
                nulla magnam deleniti, rem incidunt earum aliquid impedit nobis accusamus nostrum expedita. Aliquid quos
                cupiditate eos! Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam, accusantium?
                Exercitationem nisi, quasi temporibus voluptate, hic architecto harum consectetur porro consequuntur
                excepturi, aperiam numquam deleniti illo ullam laborum magni praesentium!
            </td>
        </tr>
        <tr>
            <td style="width: 50%; text-align: justify;">
                <div class="section-heading">Tratamiento asignado</div>
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Suscipit, explicabo. At cumque mollitia, natus
                nulla magnam deleniti, rem incidunt earum aliquid impedit nobis accusamus nostrum expedita. Aliquid quos
                cupiditate eos! Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam, accusantium?
                Exercitationem nisi, quasi temporibus voluptate, hic architecto harum consectetur porro consequuntur
                excepturi, aperiam numquam deleniti illo ullam laborum magni praesentium!
            </td>
            <td style="width: 50%; text-align: justify;">
                <div class="section-heading">Medicamentos incluídos en el tratamiento asignado</div>
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Suscipit, explicabo. At cumque mollitia, natus
                nulla magnam deleniti, rem incidunt earum aliquid impedit nobis accusamus nostrum expedita. Aliquid quos
                cupiditate eos! Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam, accusantium?
                Exercitationem nisi, quasi temporibus voluptate, hic architecto harum consectetur porro consequuntur
                excepturi, aperiam numquam deleniti illo ullam laborum magni praesentium!
            </td>
        </tr>
        <tr>
            <td style="width: 50%; text-align: justify;">
                <div class="section-heading">Evaluación psicológica final</div>
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Suscipit, explicabo. At cumque mollitia, natus
                nulla magnam deleniti, rem incidunt earum aliquid impedit nobis accusamus nostrum expedita. Aliquid quos
                cupiditate eos! Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam, accusantium?
                Exercitationem nisi, quasi temporibus voluptate, hic architecto harum consectetur porro consequuntur
                excepturi, aperiam numquam deleniti illo ullam laborum magni praesentium!
            </td>
            <td style="width: 50%; text-align: justify; background-color: #f59f0b46;">
                <div class="section-heading" style="color: #F59E0B;">Notas de la sesión</div>
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Suscipit, explicabo. At cumque mollitia, natus
                nulla magnam deleniti, rem incidunt earum aliquid impedit nobis accusamus nostrum expedita. Aliquid quos
                cupiditate eos! Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam, accusantium?
                Exercitationem nisi, quasi temporibus voluptate, hic architecto harum consectetur porro consequuntur
                excepturi, aperiam numquam deleniti illo ullam laborum magni praesentium!
            </td>
        </tr>
    </table>

    <table class="logo-table borders" style="margin-bottom: 20px;">
        <h2>Sesión #2</h2>
        <tr>
            <td style="width: 50%; text-align: justify;">
                <div class="section-heading">Diagnóstico principal</div>
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Suscipit, explicabo. At cumque mollitia, natus
                nulla magnam deleniti, rem incidunt earum aliquid impedit nobis accusamus nostrum expedita. Aliquid quos
                cupiditate eos! Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam, accusantium?
                Exercitationem nisi, quasi temporibus voluptate, hic architecto harum consectetur porro consequuntur
                excepturi, aperiam numquam deleniti illo ullam laborum magni praesentium!
            </td>
            <td style="width: 50%; text-align: justify;">
                <div class="section-heading">Historial clínico</div>
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Suscipit, explicabo. At cumque mollitia, natus
                nulla magnam deleniti, rem incidunt earum aliquid impedit nobis accusamus nostrum expedita. Aliquid quos
                cupiditate eos! Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam, accusantium?
                Exercitationem nisi, quasi temporibus voluptate, hic architecto harum consectetur porro consequuntur
                excepturi, aperiam numquam deleniti illo ullam laborum magni praesentium!
            </td>
        </tr>
        <tr>
            <td style="width: 50%; text-align: justify;">
                <div class="section-heading">Tratamiento asignado</div>
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Suscipit, explicabo. At cumque mollitia, natus
                nulla magnam deleniti, rem incidunt earum aliquid impedit nobis accusamus nostrum expedita. Aliquid quos
                cupiditate eos! Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam, accusantium?
                Exercitationem nisi, quasi temporibus voluptate, hic architecto harum consectetur porro consequuntur
                excepturi, aperiam numquam deleniti illo ullam laborum magni praesentium!
            </td>
            <td style="width: 50%; text-align: justify;">
                <div class="section-heading">Medicamentos incluídos en el tratamiento asignado</div>
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Suscipit, explicabo. At cumque mollitia, natus
                nulla magnam deleniti, rem incidunt earum aliquid impedit nobis accusamus nostrum expedita. Aliquid quos
                cupiditate eos! Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam, accusantium?
                Exercitationem nisi, quasi temporibus voluptate, hic architecto harum consectetur porro consequuntur
                excepturi, aperiam numquam deleniti illo ullam laborum magni praesentium!
            </td>
        </tr>
        <tr>
            <td style="width: 50%; text-align: justify;">
                <div class="section-heading">Evaluación psicológica final</div>
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Suscipit, explicabo. At cumque mollitia, natus
                nulla magnam deleniti, rem incidunt earum aliquid impedit nobis accusamus nostrum expedita. Aliquid quos
                cupiditate eos! Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam, accusantium?
                Exercitationem nisi, quasi temporibus voluptate, hic architecto harum consectetur porro consequuntur
                excepturi, aperiam numquam deleniti illo ullam laborum magni praesentium!
            </td>
            <td style="width: 50%; text-align: justify; background-color: #f59f0b46;">
                <div class="section-heading" style="color: #F59E0B;">Notas de la sesión</div>
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Suscipit, explicabo. At cumque mollitia, natus
                nulla magnam deleniti, rem incidunt earum aliquid impedit nobis accusamus nostrum expedita. Aliquid quos
                cupiditate eos! Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam, accusantium?
                Exercitationem nisi, quasi temporibus voluptate, hic architecto harum consectetur porro consequuntur
                excepturi, aperiam numquam deleniti illo ullam laborum magni praesentium!
            </td>
        </tr>
    </table>

    <div class="footer">
        Documento reporte del avance del paciente.
    </div>
</body>

</html>

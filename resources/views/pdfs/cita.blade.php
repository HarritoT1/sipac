<!DOCTYPE html>
<html lang="es">

@php
    $obj = (object) [
        'nombre' => 'Juan Pérez',
        'curp' => 'PEPJ800101HDFRRL09',
        'correo' => 'juan.perez@example.com',
        'telefono' => '555-123-4567',
        'fecha_cita' => '2024-06-15',
        'hora_cita' => '10:30 AM',
        'duracion' => '1 hora',
        'modalidad' => 'Presencial',
        'estado' => 'Confirmada',
        'cedula_profesional' => '1234567',
        'especialidad' => 'Psicología Clínica',
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
            vertical-align: top;
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
    <h1>Detalle de la cita:</h1>

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
                    <span class="field-label">Fecha de la cita:</span><br>
                    {{ $obj->fecha_cita }}
                </p>

                <p>
                    <span class="field-label">Hora de la cita:</span><br>
                    {{ $obj->hora_cita }}
                </p>

                <p>
                    <span class="field-label">Duración aproximada:</span><br>
                    {{ $obj->duracion }}
                </p>
            </td>

            <td class="profile">
                <img src="perfil.jpg" alt="Fotografía del paciente" class="profile-image">

                <div class="tag tag-gold">
                    Modalidad: {{ $obj->modalidad }}
                </div>

                <div class="tag tag-red">
                    Estado: {{ $obj->estado }}
                </div>
            </td>
        </tr>
    </table>

    <div class="separator"></div>

    <!-- Motivo de la cita -->
    <div class="section-box keep-together">
        <div class="section-heading">Motivo de la cita:</div>

        <div class="reason">
            Lorem ipsum dolor sit amet consectetur adipisicing elit.
            Deleniti, unde tempore a explicabo quas laborum officiis,
            repellat magni ab similique accusamus. Maiores vel repudiandae
            perferendis at reiciendis eius reprehenderit culpa.
        </div>
    </div>

    <div class="separator"></div>

    <!-- Profesional responsable -->
    <div class="professional keep-together">
        <h2>Profesional responsable:</h2>

        <p><strong>Dr. Juan Pérez</strong></p>

        <img src="hacker.jpg" alt="Fotografía del profesional" class="professional-image">

        <div class="tag tag-gold">
            Cédula profesional: {{ $obj->cedula_profesional }}
        </div>

        <div class="tag tag-red">
            Especialidad: {{ $obj->especialidad }}
        </div>
    </div>

    <div class="separator"></div>

    <!-- Indicaciones importantes -->
    <div class="notice">
        <div class="section-heading">Importante:</div>

        <ul>
            <li>Por favor, llegue 15 minutos antes de su cita.</li>

            <li>
                Para recibir atención es indispensable tener una cita
                previamente programada y contar con el turno impreso.
            </li>

            <li>Recuerde traer identificación oficial.</li>

            <li>
                Si necesita cancelar o reprogramar, notifíquenos con al
                menos 24 horas de anticipación.
            </li>
        </ul>
    </div>

    <div class="separator"></div>

    <div class="footer">
        Documento informativo de la cita.
    </div>

</body>

</html>

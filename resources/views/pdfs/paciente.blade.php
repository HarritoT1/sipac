<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="SIPAC - Sistema de Atención Psicológica Comunitaria" />
    <meta name="author" content="Ing. Karina Sayuri Diaz Martinez" />
    <link rel="icon" href="{{ public_path('img/logo_without_back.png') }}" />

    <title>{{ config('app.name', 'SIPAC') }}</title>

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
                    <img src="{{ public_path('img/cdmx.jpeg') }}" alt="Logo CDMX" class="logo">
                </td>
                <td>
                    <img src="{{ public_path('img/logo_tlahuac.svg') }}" alt="Logo Tláhuac" class="logo">
                </td>
                <td>
                    <!-- Es preferible utilizar PNG si el SVG no se renderiza -->
                    <img src="{{ public_path('img/tlahuac.jpeg') }}" alt="Logo de la alcaldía" class="logo">
                </td>
                <td>
                    <!-- Es preferible utilizar PNG si el SVG no se renderiza -->
                    <img src="{{ public_path('img/2026.jpeg') }}" alt="Logo de la alcaldía" class="logo">
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
                    {{ $patient->user->full_name }}
                </p>

                <p>
                    <span class="field-label">CURP:</span><br>
                    {{ $patient->user->curp }}
                </p>

                <p>
                    <span class="field-label">Correo electrónico:</span><br>
                    {{ $patient->user->email }}
                </p>

                <p>
                    <span class="field-label">Teléfono:</span><br>
                    {{ $patient->user->phone_number }}
                </p>

                <p>
                    <span class="field-label">Dirección:</span><br>
                    {{ $patient->user->home_address }}
                </p>

                <p>
                    <span class="field-label">Nacimiento:</span><br>
                    {{ $patient->birth_date->locale('es')->isoFormat('D [de] MMMM [del] YYYY') }}
                </p>

                <p>
                    <span class="field-label">Género:</span><br>
                    {{ $patient->gender }}
                </p>
            </td>

            <td class="profile">
                <img src="{{ storage_path('app/public/' . $patient->user->avatar_url) }}"
                    alt="{{ $patient->user->full_name }}" class="profile-image">

                <div class="tag {{ $patient->user->is_active ? 'tag-gold' : 'tag-red' }}">
                    Estado activo: {{ $patient->user->is_active ? 'SI' : 'NO' }}
                </div>

            </td>
        </tr>
    </table>

    <div class="separator"></div>

    <!-- Indicaciones importantes -->
    <div class="notice">
        <div class="section-heading">Contactos de emergencia:</div>

        @if ($patient->emergency_contacts->isEmpty())
            <div role="alert" style="text-align: center; font-weight: bold; font-size: 16px;">
                Este paciente no tiene contactos de emergencia.
            </div>
        @else
            <table class="logo-table borders">
                <tr>
                    <th>Nombre</th>
                    <th>Relación</th>
                    <th>Teléfono</th>
                    <th>Correo electrónico</th>
                    <th>Es principal</th>
                </tr>
                @foreach ($patient->emergency_contacts as $contact)
                    <tr>
                        <td style="width: 20%; text-align: center;">{{ $contact->name }}</td>
                        <td style="width: 20%; text-align: center;">{{ $contact->relationship }}</td>
                        <td style="width: 20%; text-align: center;">{{ $contact->phone_number }}</td>
                        <td style="width: 20%; text-align: center;">{{ $contact->email ?? 'Sin correo electrónico' }}
                        </td>
                        <td style="width: 20%; text-align: center;">{{ $contact->is_primary ? 'SI' : 'NO' }}</td>
                    </tr>
                @endforeach
            </table>
        @endif
    </div>

    <div class="separator"></div>

    <br>
    <h2>Historial de terapias (sesiones) de las citas:</h2>

    @if ($patientSessionRecords->isEmpty())
        <div role="alert" style="text-align: center; font-weight: bold; font-size: 16px;">
            Este paciente no tiene sesiones de terapia registradas.
        </div>
    @else
        @foreach ($patientSessionRecords as $index => $patientSessionRecord)
            <table class="logo-table borders" style="margin-bottom: 20px;">
                <h2>Sesión #{{ $index + 1 }}</h2>
                <tr>
                    <td style="width: 50%; text-align: justify;">
                        <div class="section-heading">Diagnóstico principal</div>
                        {{ $patientSessionRecord->diagnosis }}
                    </td>
                    <td style="width: 50%; text-align: justify;">
                        <div class="section-heading">Historial clínico</div>
                        {{ $patientSessionRecord->clinical_history ?? 'Sin historial clínico.' }}
                    </td>
                </tr>
                <tr>
                    <td style="width: 50%; text-align: justify;">
                        <div class="section-heading">Tratamiento asignado</div>
                        {{ $patientSessionRecord->treatment ?? 'Sin tratamiento asignado.' }}
                    </td>
                    <td style="width: 50%; text-align: justify;">
                        <div class="section-heading">Medicamentos incluídos en el tratamiento asignado</div>
                        {{ $patientSessionRecord->medications ?? 'Sin medicamentos incluídos.' }}
                    </td>
                </tr>
                <tr>
                    <td style="width: 50%; text-align: justify;">
                        <div class="section-heading">Evaluación psicológica final</div>
                        {{ $patientSessionRecord->psychological_evaluation }}
                    </td>
                    <td style="width: 50%; text-align: justify; background-color: #f59f0b46;">
                        <div class="section-heading" style="color: #F59E0B;">Notas de la sesión</div>
                        {{ $patientSessionRecord->therapy_notes ?? 'Sin notas de la sesión.' }}
                    </td>
                </tr>
            </table>
        @endforeach
    @endif

    <div class="footer">
        Documento reporte del avance del paciente.
    </div>
</body>

</html>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">

    <title>
        Reporte Diario de Citas
    </title>

    <style>

        body {
            font-family: Helvetica, sans-serif;
            color: #333;
            line-height: 1.6;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #D4AF37;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #D4AF37;
        }

        .report-title {
            font-size: 18px;
            margin-top: 5px;
            color: #666;
        }

        .info-section {
            margin-bottom: 20px;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th {
            background-color: #f3f4f6;
            color: #374151;
            font-weight: bold;
            text-align: left;
            padding: 10px;
            border: 1px solid #e5e7eb;
        }

        td {
            padding: 10px;
            border: 1px solid #e5e7eb;
            font-size: 12px;
        }

        tr:nth-child(even) {
            background-color: #f9fafb;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #9ca3af;
            border-top: 1px solid #e5e7eb;
            padding-top: 10px;
        }

    </style>

</head>

<body>

    <div class="header">

        <div class="logo">
            AURA BARBER
        </div>

        <div class="report-title">
            Reporte Diario de Citas - {{ $date }}
        </div>

        <div style="font-size: 12px; color: #888;">

            Destinatario: {{ $recipientType }}

        </div>

    </div>

    <div class="info-section">

        <p>
            A continuación se muestra la lista de citas programadas para hoy.
        </p>

    </div>

    <table>

        <thead>

            <tr>

                <th>Hora</th>

                <th>Cliente</th>

                <th>Especialista</th>

                <th>Servicio</th>

                <th>Notas</th>

            </tr>

        </thead>

        <tbody>

            @forelse($appointments as $app)

                <tr>

                    <td>
                        {{ \Carbon\Carbon::parse($app->time)->format('H:i') }}
                    </td>

                    <td>
                        {{ $app->client->name }}
                    </td>

                    <td>
                        {{ $app->specialist->user->name }}
                    </td>

                    <td>
                        {{ $app->service->name }}
                    </td>

                    <td>
                        {{ $app->notes ?: 'N/A' }}
                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="5" style="text-align: center;">
                        No hay citas programadas para hoy.
                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

    <div class="footer">

        Sistema automático de reportes Aura Barber.<br>

        © {{ date('Y') }} Aura Barber.

    </div>

</body>
</html>
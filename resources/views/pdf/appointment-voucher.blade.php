<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Comprobante de Cita</title>

    <style>
        body {
            font-family: Helvetica, Arial, sans-serif;
            color: #333;
            line-height: 1.6;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #D4AF37;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .header h1 {
            color: #D4AF37;
            margin: 0;
            font-size: 24px;
        }

        .header p {
            margin: 5px 0;
            color: #666;
        }

        .section {
            margin-bottom: 20px;
        }

        .section-title {
            font-weight: bold;
            color: #D4AF37;
            border-bottom: 1px solid #e5e7eb;
            margin-bottom: 10px;
            padding-bottom: 5px;
        }

        .data-row {
            margin-bottom: 8px;
        }

        .label {
            font-weight: bold;
            width: 150px;
            display: inline-block;
        }

        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
            color: #9ca3af;
            border-top: 1px solid #e5e7eb;
            padding-top: 20px;
        }

        .badge {
            background-color: #D4AF37;
            color: black;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 14px;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="header">
        <h1>Aura Barber</h1>

        <p>Comprobante de Cita #{{ $appointment->id }}</p>
    </div>

    <div class="section">

        <div class="section-title">
            Información del Cliente
        </div>

        <div class="data-row">
            <span class="label">Nombre:</span>

            <span>
                {{ $appointment->client->name }}
            </span>
        </div>

        <div class="data-row">
            <span class="label">Email:</span>

            <span>
                {{ $appointment->client->email }}
            </span>
        </div>

    </div>

    <div class="section">

        <div class="section-title">
            Detalles de la Cita
        </div>

        <div class="data-row">
            <span class="label">Especialista:</span>

            <span>
                {{ $appointment->specialist->user->name }}
            </span>
        </div>

        <div class="data-row">
            <span class="label">Especialidad:</span>

            <span>
                {{ $appointment->specialist->specialty }}
            </span>
        </div>

        <div class="data-row">
            <span class="label">Servicio:</span>

            <span>
                {{ $appointment->service->name }}
            </span>
        </div>

        <div class="data-row">
            <span class="label">Precio:</span>

            <span>
                ${{ number_format($appointment->service->price, 2) }}
            </span>
        </div>

        <div class="data-row">
            <span class="label">Duración:</span>

            <span>
                {{ $appointment->service->duration }} min
            </span>
        </div>

        <div class="data-row">
            <span class="label">Fecha:</span>

            <span>
                {{ \Carbon\Carbon::parse($appointment->date)->format('d/m/Y') }}
            </span>
        </div>

        <div class="data-row">
            <span class="label">Hora:</span>

            <span>
                {{ \Carbon\Carbon::parse($appointment->time)->format('H:i') }}
            </span>
        </div>

        <div class="data-row">
            <span class="label">Estado:</span>

            <span class="badge">
                Programada
            </span>
        </div>

    </div>

    @if($appointment->notes)

        <div class="section">

            <div class="section-title">
                Notas
            </div>

            <p>
                {{ $appointment->notes }}
            </p>

        </div>

    @endif

    <div class="footer">

        <p>
            Gracias por elegir Aura Barber.
        </p>

        <p>
            © {{ date('Y') }} Aura Barber.
        </p>

    </div>

</body>
</html>
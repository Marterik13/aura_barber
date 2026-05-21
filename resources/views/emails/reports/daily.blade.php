<x-mail::message>

# Reporte Diario de Citas - {{ date('d/m/Y') }}

Hola,

Se adjunta la lista de citas programadas para el día de hoy.

<x-mail::table>

| Hora | Cliente | Especialista | Servicio |
| :--- | :--- | :--- | :--- |

@foreach($appointments as $app)

| {{ \Carbon\Carbon::parse($app->time)->format('H:i') }} | {{ $app->client->name }} | {{ $app->specialist->user->name }} | {{ $app->service->name }} |

@endforeach

</x-mail::table>

Total de citas: **{{ $appointments->count() }}**

Gracias,<br>
{{ config('app.name') }}

</x-mail::message>
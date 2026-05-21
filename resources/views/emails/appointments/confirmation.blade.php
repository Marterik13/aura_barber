<x-mail::message>

# Confirmación de Cita - Aura Barber

Hola **{{ $appointment->client->name }}**,

Tu cita fue agendada correctamente.

<x-mail::panel>

### Detalles de la cita

- 📅 **Fecha:** {{ \Carbon\Carbon::parse($appointment->date)->format('d/m/Y') }}

- ⏰ **Hora:** {{ \Carbon\Carbon::parse($appointment->time)->format('H:i') }}

- ✂️ **Especialista:** {{ $appointment->specialist->user->name }}

- 💈 **Especialidad:** {{ $appointment->specialist->specialty }}

- 🧾 **Servicio:** {{ $appointment->service->name }}

- 💵 **Precio:** ${{ number_format($appointment->service->price, 2) }}

- ⏳ **Duración:** {{ $appointment->service->duration }} min

</x-mail::panel>

@if($appointment->notes)

### Notas

{{ $appointment->notes }}

@endif

Gracias por elegir **Aura Barber**.

<x-mail::button :url="url('/')">
Ir al sitio
</x-mail::button>

Saludos,<br>
{{ config('app.name') }}

</x-mail::message>
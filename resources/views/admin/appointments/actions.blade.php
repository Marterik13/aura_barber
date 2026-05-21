<div class="flex items-center gap-2">

    <form
        action="{{ route('admin.appointments.send-email', $appointment) }}"
        method="POST"
    >
        @csrf

        <x-wire-button
            type="submit"
            icon="envelope"
            emerald
            xs
        />
    </form>

</div>
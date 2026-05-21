<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl gold-text leading-tight">
            {{ __('Crear Cita') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#1A1A1A] border border-gray-800 overflow-hidden shadow-2xl sm:rounded-3xl">
                <div class="p-12 md:p-16">
                 <x-admin-header title="Crear Cita" :breadcrumbs="[
    ['name' => 'Dashboard', 'href' => route('admin.dashboard')],
    ['name' => 'Citas', 'href' => route('admin.appointments.index')],
    ['name' => 'Crear']
]"/>   
                
                <form action="{{ route('admin.appointments.store') }}" method="POST">
                    @csrf

                    @if ($errors->any())
                        <div class="mb-6">
                            <div class="font-bold text-red-600 text-lg">¡Ups! Algo salió mal.</div>
                            <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        <div>
                            <div>
    <label class="block text-sm font-medium text-gray-300 mb-1">
        Cliente
    </label>

    <select
        name="client_id"
        required
        class="block w-full bg-[#111] border-gray-700 text-black rounded-md shadow-sm focus:border-[#D4AF37] focus:ring focus:ring-[#D4AF37] focus:ring-opacity-50 sm:text-sm"
    >
        <option value="" disabled selected>
            Seleccione un cliente
        </option>

        @foreach ($clients as $client)
            <option value="{{ $client->id }}">
                {{ $client->name }}
            </option>
        @endforeach
    </select>
</div>
                        </div>

                        <div>
                            <div>
    <label class="block text-sm font-medium text-gray-300 mb-1">
        Especialista
    </label>

    <select
        id="specialist-select"
        name="specialist_id"
        required
        class="block w-full bg-[#111] border-gray-700 text-black rounded-md shadow-sm focus:border-[#D4AF37] focus:ring focus:ring-[#D4AF37] focus:ring-opacity-50 sm:text-sm"
    >
        <option value="" disabled selected>
            Seleccione un especialista
        </option>

        @foreach ($specialists as $specialist)
            <option
                value="{{ $specialist->id }}"
                data-start="{{ $specialist->start_time }}"
                data-end="{{ $specialist->end_time }}"
            >
                {{ $specialist->user->name ?? 'Desconocido' }}
                ({{ $specialist->specialty }})
            </option>
        @endforeach
    </select>
</div>
                        </div>

                        <div>
                            <div>
    <label class="block text-sm font-medium text-gray-300 mb-1">
        Servicio
    </label>

    <select
        name="service_id"
        required
        class="block w-full bg-[#111] border-gray-700 text-black rounded-md shadow-sm focus:border-[#D4AF37] focus:ring focus:ring-[#D4AF37] focus:ring-opacity-50 sm:text-sm"
    >
        <option value="" disabled selected>
            Seleccione un servicio
        </option>

        @foreach ($services as $service)
            <option value="{{ $service->id }}">
                {{ $service->name }}
                (${{ number_format($service->price, 2) }})
                - {{ $service->duration }} min
            </option>
        @endforeach
    </select>
</div>
                        </div>

                        <div>
                            <x-wire-input label="Fecha" name="date" type="date" :value="old('date')" required />
                        </div>

                        <div>
                            <div>
    <label class="block text-sm font-medium text-gray-300 mb-1">
        Hora
    </label>

    <select
        id="time-select"
        name="time"
        required
        class="block w-full bg-[#111] border-gray-700 text-black rounded-md shadow-sm focus:border-[#D4AF37] focus:ring focus:ring-[#D4AF37] focus:ring-opacity-50 sm:text-sm"
    >
        <option value="" disabled selected>
            Seleccione una hora
        </option>
    </select>
</div>
                        </div>

                        <div class="md:col-span-2">
                            <x-wire-textarea label="Notas (opcional)" name="notes" placeholder="Alguna petición especial...">{{ old('notes') }}</x-wire-textarea>
                        </div>

                    </div>

                    <div class="flex items-center justify-end mt-8">
                        <x-wire-button flat label="Cancelar" href="{{ route('admin.appointments.index') }}" class="mr-4" />
                        <x-wire-button 
                            class="bg-gradient-to-r from-[#BF953F] to-[#AA771C] hover:scale-105 text-black px-6 py-2 uppercase tracking-widest text-xs font-bold shadow-md transition-all" 
                            label="Guardar" 
                            type="submit" 
                        />
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
    <script>
    const specialistSelect = document.getElementById('specialist-select');
    const timeSelect = document.getElementById('time-select');

    specialistSelect.addEventListener('change', function () {

        const selectedOption = this.options[this.selectedIndex];

        const start = parseInt(selectedOption.dataset.start);
        const end = parseInt(selectedOption.dataset.end);

        timeSelect.innerHTML =
            '<option value="" disabled selected>Seleccione una hora</option>';

        for (let hour = start; hour <= end; hour++) {

            const formattedHour =
                String(hour).padStart(2, '0') + ':00';

            const option = document.createElement('option');

            option.value = formattedHour;
            option.textContent = formattedHour;

            timeSelect.appendChild(option);
        }
    });
</script>
</x-app-layout>

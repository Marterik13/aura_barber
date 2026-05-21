<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl gold-text leading-tight">
            {{ __('Editar Especialista: ') }} {{ $specialist->user->name ?? 'Usuario Desconocido' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#1A1A1A] border border-gray-800 overflow-hidden shadow-2xl sm:rounded-3xl">
                <div class="p-12 md:p-16">
                
                <form action="{{ route('admin.specialists.update', $specialist) }}" method="POST">
                    @csrf
                    @method('PUT')

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
        Usuario
    </label>

    <select
        disabled
        class="block w-full bg-[#111] border-gray-700 text-gray-400 rounded-md shadow-sm sm:text-sm cursor-not-allowed"
    >
        <option selected>
            {{ $specialist->user->name ?? 'Usuario Desconocido' }}
            ({{ $specialist->user->email ?? '' }})
        </option>
    </select>

    <input
        type="hidden"
        name="user_id"
        value="{{ $specialist->user_id }}"
    />
</div>
                         </div>

                        <div>
                             <div>
    <label class="block text-sm font-medium text-gray-300 mb-1">
        Especialidad
    </label>

    <select
        name="specialty"
        required
        class="block w-full bg-[#111] border-gray-700 text-white rounded-md shadow-sm focus:border-[#D4AF37] focus:ring focus:ring-[#D4AF37] focus:ring-opacity-50 sm:text-sm"
    >
        <option value="" disabled>
            Seleccione especialidad
        </option>

        <option
            value="Barbero"
            {{ old('specialty', $specialist->specialty) == 'Barbero' ? 'selected' : '' }}
        >
            Barbero
        </option>

        <option
            value="Mixto"
            {{ old('specialty', $specialist->specialty) == 'Mixto' ? 'selected' : '' }}
        >
            Mixto
        </option>

        <option
            value="Estilista"
            {{ old('specialty', $specialist->specialty) == 'Estilista' ? 'selected' : '' }}
        >
            Estilista
        </option>
    </select>
</div>
                        </div>

                        <div class="md:col-span-2">
                            <x-wire-textarea label="Biografía" name="bio" placeholder="Breve descripción de la experiencia del especialista">{{ old('bio', $specialist->bio) }}</x-wire-textarea>
                        </div>

                        <div>
                            <div>
    <label class="block text-sm font-medium text-gray-300 mb-1">
        Hora de Inicio
    </label>

    <select
        name="start_time"
        required
        class="block w-full bg-[#111] border-gray-700 text-white rounded-md shadow-sm focus:border-[#D4AF37] focus:ring focus:ring-[#D4AF37] focus:ring-opacity-50 sm:text-sm"
    >
        @for ($i = 8; $i <= 22; $i++)
            <option
                value="{{ $i }}"
                {{ old('start_time', $specialist->start_time) == $i ? 'selected' : '' }}
            >
                {{ $i }}:00
            </option>
        @endfor
    </select>
</div>
                        </div>

                        <div>
                            <div>
    <label class="block text-sm font-medium text-gray-300 mb-1">
        Hora de Fin
    </label>

    <select
        name="end_time"
        required
        class="block w-full bg-[#111] border-gray-700 text-white rounded-md shadow-sm focus:border-[#D4AF37] focus:ring focus:ring-[#D4AF37] focus:ring-opacity-50 sm:text-sm"
    >
        @for ($i = 8; $i <= 22; $i++)
            <option
                value="{{ $i }}"
                {{ old('end_time', $specialist->end_time) == $i ? 'selected' : '' }}
            >
                {{ $i }}:00
            </option>
        @endfor
    </select>
</div>
                        </div>

                    </div>

                    <div class="flex items-center justify-end mt-8">
                        <x-wire-button flat label="Cancelar" href="{{ route('admin.specialists.index') }}" class="mr-4" />
                        <x-wire-button 
                            class="bg-gradient-to-r from-[#BF953F] to-[#AA771C] hover:scale-105 text-black px-6 py-2 uppercase tracking-widest text-xs font-bold shadow-md transition-all" 
                            label="Actualizar" 
                            type="submit" 
                        />
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl gold-text leading-tight">
            {{ __('Crear Especialista') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#1A1A1A] border border-gray-800 overflow-hidden shadow-2xl sm:rounded-3xl">
                                 <x-admin-header title="Crear Especialista" :breadcrumbs="[
    ['name' => 'Dashboard', 'href' => route('admin.dashboard')],
    ['name' => 'Especialistas', 'href' => route('admin.specialists.index')],
    ['name' => 'Crear']
]"/>  
                <div class="p-12 md:p-16">
                    
                
                <form action="{{ route('admin.specialists.store') }}" method="POST">
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
                            <label class="block text-sm font-medium text-gray-300 mb-1">Usuario</label>
                            <select name="user_id" required class="block w-full bg-[#111] border-gray-700 text-black rounded-md shadow-sm focus:border-[#D4AF37] focus:ring focus:ring-[#D4AF37] focus:ring-opacity-50 sm:text-sm">
                                <option value="" disabled selected>Seleccione un usuario</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Especialidad</label>
                            <select name="specialty" required class="block w-full bg-[#111] border-gray-700 text-black rounded-md shadow-sm focus:border-[#D4AF37] focus:ring focus:ring-[#D4AF37] focus:ring-opacity-50 sm:text-sm">
                                <option value="" disabled selected>Seleccione especialidad</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="md:col-span-2">
                            <x-wire-textarea label="Biografía" name="bio" placeholder="Breve descripción de la experiencia del especialista">{{ old('bio') }}</x-wire-textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Hora de Inicio</label>
                            <select name="start_time" required class="block w-full bg-[#111] border-gray-700 text-black rounded-md shadow-sm focus:border-[#D4AF37] focus:ring focus:ring-[#D4AF37] focus:ring-opacity-50 sm:text-sm">
                                <option value="" disabled selected>Seleccione hora de inicio</option>
                                @for ($i = 8; $i <= 12; $i++)
                                    <option value="{{ $i }}">{{ $i }}:00</option>
                                @endfor
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Hora de Fin</label>
                            <select name="end_time" required class="block w-full bg-[#111] border-gray-700 text-black rounded-md shadow-sm focus:border-[#D4AF37] focus:ring focus:ring-[#D4AF37] focus:ring-opacity-50 sm:text-sm">
                                <option value="" disabled selected>Seleccione hora de fin</option>
                                @for ($i = 16; $i <= 22; $i++)
                                    <option value="{{ $i }}">{{ $i }}:00</option>
                                @endfor
                            </select>
                        </div>

                    </div>

                    <div class="flex items-center justify-end mt-8">
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
</x-app-layout>

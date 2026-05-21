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
                            <x-wire-select label="Usuario" name="user_id" placeholder="Seleccione un usuario" required>
                                @foreach ($users as $user)
                                    <x-wire-select.option label="{{ $user->name }} ({{ $user->email }})" value="{{ $user->id }}" :selected="$specialist->user_id == $user->id" />
                                @endforeach
                            </x-wire-select>
                        </div>

                        <div>
                            <x-wire-input label="Especialidad" name="specialty" 
                                :value="old('specialty', $specialist->specialty)" 
                                placeholder="Ej. Barbero Principal" required />
                        </div>

                        <div class="md:col-span-2">
                            <x-wire-textarea label="Biografía" name="bio" placeholder="Breve descripción de la experiencia del especialista">{{ old('bio', $specialist->bio) }}</x-wire-textarea>
                        </div>

                        <div>
                            <x-wire-select label="Hora de Inicio" name="start_time" placeholder="Seleccione hora de inicio" required>
                                @for ($i = 8; $i <= 22; $i++)
                                    <x-wire-select.option label="{{ $i }}:00" value="{{ $i }}" :selected="$specialist->start_time == $i" />
                                @endfor
                            </x-wire-select>
                        </div>

                        <div>
                            <x-wire-select label="Hora de Fin" name="end_time" placeholder="Seleccione hora de fin" required>
                                @for ($i = 8; $i <= 22; $i++)
                                    <x-wire-select.option label="{{ $i }}:00" value="{{ $i }}" :selected="$specialist->end_time == $i" />
                                @endfor
                            </x-wire-select>
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

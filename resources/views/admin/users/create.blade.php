<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl gold-text leading-tight">
            {{ __('Crear Usuario') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#1A1A1A] border border-gray-800 overflow-hidden shadow-2xl sm:rounded-3xl">
                <div class="p-12 md:p-16">
                
                <form action="{{ route('admin.users.store') }}" method="POST">
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
                            <x-wire-input label="Nombre" name="name" :value="old('name')" placeholder="Nombre completo" required />
                        </div>

                        <div>
                            <x-wire-input label="Correo electrónico" name="email" :value="old('email')" type="email" placeholder="ejemplo@dominio.com" required />
                        </div>

                        <div>
                            <x-wire-input name="password" label="Contraseña" type="password" placeholder="Mínimo 8 caracteres" required />
                        </div>

                        <div>
                            <x-wire-input name="password_confirmation" label="Confirmar contraseña" type="password" placeholder="Repita la contraseña" required />
                        </div>

                        <div>
                            <x-wire-input label="Número de ID" name="id_number" :value="old('id_number')" placeholder="Ej. 123456789" required />
                        </div>

                        <div>
                            <x-wire-input label="Teléfono" name="phone" :value="old('phone')" placeholder="Ej. 999999999" required />
                        </div>

                        <div class="md:col-span-2">
                            <x-wire-input label="Dirección" name="address" :value="old('address')" placeholder="Ej. Calle 90 293" required />
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-300 mb-1">Rol</label>
                            <select name="rol_id" required class="block w-full bg-[#111] border-gray-700 text-white rounded-md shadow-sm focus:border-[#D4AF37] focus:ring focus:ring-[#D4AF37] focus:ring-opacity-50 sm:text-sm">
                                <option value="" disabled selected>Seleccione un rol</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                            <p class="mt-2 text-sm text-gray-500">Define los permisos y accesos del usuario</p>
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
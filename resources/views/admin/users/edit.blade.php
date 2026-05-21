<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl gold-text leading-tight">
            {{ __('Editar Usuario: ') }} {{ $user->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#1A1A1A] border border-gray-800 overflow-hidden shadow-2xl sm:rounded-3xl">
                
                <x-admin-header title="Editar Usuario" :breadcrumbs="[
    ['name' => 'Dashboard', 'href' => route('admin.dashboard')],
    ['name' => 'Usuarios', 'href' => route('admin.users.index')],
    ['name' => 'Editar']
]"/> 
                <div class="p-12 md:p-16">
                
                <form action="{{ route('admin.users.update', $user) }}" method="POST">
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
                            <x-wire-input label="Nombre" name="name" 
                                :value="old('name', $user->name)" 
                                placeholder="Nombre completo" required />
                        </div>

                        <div>
                            <x-wire-input label="Correo electrónico" name="email" 
                                :value="old('email', $user->email)" 
                                type="email" placeholder="ejemplo@dominio.com" required />
                        </div>

                        <div>
                            <x-wire-input name="password" label="Nueva Contraseña" 
                                type="password" placeholder="Dejar en blanco para no cambiar" />
                        </div>

                        <div>
                            <x-wire-input name="password_confirmation" label="Confirmar nueva contraseña" 
                                type="password" placeholder="Repita la contraseña" />
                        </div>

                        <div>
                            <x-wire-input label="Número de ID" name="id_number" 
                                :value="old('id_number', $user->id_number)" 
                                placeholder="Ej. 123456789" required />
                        </div>

                        <div>
                            <x-wire-input label="Teléfono" name="phone" 
                                :value="old('phone', $user->phone)" 
                                placeholder="Ej. 999999999" required />
                        </div>

                        <div class="md:col-span-2">
                            <x-wire-input label="Dirección" name="address" 
                                :value="old('address', $user->address)" 
                                placeholder="Ej. Calle 90 293" required />
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-300 mb-1">Rol</label>
                            <select name="rol_id" required class="block w-full bg-[#111] border-gray-700 text-black rounded-md shadow-sm focus:border-[#D4AF37] focus:ring focus:ring-[#D4AF37] focus:ring-opacity-50 sm:text-sm">
                                <option value="" disabled>Seleccione un rol</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-8">
                        <x-wire-button flat label="Cancelar" href="{{ route('admin.users.index') }}" class="mr-4" />
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
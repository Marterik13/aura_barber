<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl gold-text leading-tight">
            {{ __('Crear Servicio') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#1A1A1A] border border-gray-800 overflow-hidden shadow-2xl sm:rounded-3xl">
                <div class="p-12 md:p-16">
                                     <x-admin-header title="Crear Servicio" :breadcrumbs="[
    ['name' => 'Dashboard', 'href' => route('admin.dashboard')],
    ['name' => 'Servicios', 'href' => route('admin.services.index')],
    ['name' => 'Crear']
]"/>  
                
                <form action="{{ route('admin.services.store') }}" method="POST">
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
                            <x-wire-input label="Nombre" name="name" :value="old('name')" placeholder="Nombre del servicio" required />
                        </div>

                        <div>
                            <x-wire-input label="Precio" name="price" :value="old('price')" type="number" step="0.01" placeholder="Ej. 15.00" required />
                        </div>

                        <div>
                            <x-wire-input label="Duración (minutos)" name="duration" :value="old('duration')" type="number" placeholder="Ej. 30" required />
                        </div>

                        <div class="md:col-span-2">
                            <x-wire-textarea label="Descripción" name="description" placeholder="Breve descripción del servicio">{{ old('description') }}</x-wire-textarea>
                        </div>

                    </div>

                    <div class="flex items-center justify-end mt-8">
                        <x-wire-button 
                            amber
                            label="Guardar" 
                            type="submit" 
                        />
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
    <x-admin-alerts />
</x-app-layout>

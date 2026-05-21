<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl gold-text leading-tight">
                {{ __('Gestión de Servicios') }}
            </h2>
            <a href="{{ route('admin.services.create') }}" style="background: linear-gradient(to right, #BF953F, #FCF6BA, #B38728);" class="text-black font-bold px-6 py-2 rounded-xl shadow-lg hover:scale-105 transition-all flex items-center">
                <i class="fa-solid fa-plus mr-2"></i> Nuevo Servicio
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#1A1A1A] border border-gray-800 overflow-hidden shadow-2xl sm:rounded-3xl">

    <x-admin-header title="Servicios" :breadcrumbs="[
    ['name' => 'Dashboard', 'href' => route('admin.dashboard')],
    ['name' => 'Servicios']
]"/>  
                <div class="p-12 md:p-16">
                    <h3 class="text-3xl font-bold mb-4">Catálogo de <span class="gold-text">Servicios</span></h3>
                    <p class="text-gray-400 text-lg mb-8">Administra los servicios que ofreces en Aura Aesthetics.</p>
                    
                    <div class="mt-6 dark-table-container">
                        @livewire('admin.Datatables.service-table')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

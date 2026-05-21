<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl gold-text leading-tight">
                {{ __('Gestión de Usuarios') }}
            </h2>
            <x-wire-button href="{{ route('admin.users.create') }}" class="bg-gradient-to-r from-[#BF953F] to-[#AA771C] text-black font-bold border-none hover:scale-105 transition-all">
                <i class="fa-solid fa-plus mr-2"></i> Nuevo
            </x-wire-button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#1A1A1A] border border-gray-800 overflow-hidden shadow-2xl sm:rounded-3xl">
                <div class="p-12 md:p-16">
                    <h3 class="text-3xl font-bold mb-4">Gestión de <span class="gold-text">Usuarios</span></h3>
                    <p class="text-gray-400 text-lg mb-8">Administra los accesos y roles del sistema.</p>
                    
                    <div wire:key="users-table-container" class="dark-table-container mt-6">
                        @livewire('admin.Datatables.user-table')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 
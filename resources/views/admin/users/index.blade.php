<x-admin-layout title="Usuarios" :breadcrumbs="[
    ['name' => 'Dashboard', 'href' => route('dashboard')],
    ['name' => 'Usuarios']
]">

    {{-- Definimos el slot 'action' aquí --}}
    <x-slot name="action">
        <x-wire-button href="{{ route('admin.users.create') }}" class="bg-gradient-to-r from-[#BF953F] to-[#AA771C] text-black font-bold border-none hover:scale-105 transition-all">
            <i class="fa-solid fa-plus mr-2"></i>
            Nuevo
        </x-wire-button>
    </x-slot>

    <div wire:key="users-table-container" class="dark-table-container mt-6">
        @livewire('admin.Datatables.user-table')
    </div>

</x-admin-layout> 
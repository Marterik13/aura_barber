<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl gold-text leading-tight">
            {{ __('Panel de Control') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#1A1A1A] border border-gray-800 overflow-hidden shadow-2xl sm:rounded-3xl">
                <x-admin-header title="Dashboard" :breadcrumbs="[
    ['name' => 'Dashboard', 'href' => route('admin.dashboard')],
]"/> 
                <div class="p-12 md:p-16">
                    <h3 class="text-3xl font-bold mb-4">Bienvenido, <span class="gold-text">{{ Auth::user()->name }}</span></h3>
                    <p class="text-gray-400 text-lg mb-4">GAquí tienes un resumen de tu actividad.</p>
                    
                    <!-- Appointment Scheduler Widget -->
                    @livewire('admin.dashboard-appointment-creator')
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl gold-text leading-tight">
            {{ __('Panel de Control') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#1A1A1A] border border-gray-800 overflow-hidden shadow-2xl sm:rounded-2xl">
                <div class="p-8">
                    <h3 class="text-3xl font-bold mb-4">Bienvenido, <span class="gold-text">{{ Auth::user()->name }}</span></h3>
                    <p class="text-gray-400 text-lg mb-8">Gestiona tu barbería con precisión y estilo. Aquí tienes un resumen de tu actividad.</p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Stat Card 1 -->
                        <div class="bg-black/40 p-6 rounded-xl border border-gray-800 hover:border-[#D4AF37] transition-all">
                            <div class="text-[#D4AF37] mb-2">
                                <i class="fa-solid fa-calendar-check text-2xl"></i>
                            </div>
                            <div class="text-3xl font-bold">0</div>
                            <div class="text-gray-500 uppercase text-xs tracking-widest mt-1">Citas Hoy</div>
                        </div>
                        
                        <!-- Stat Card 2 -->
                        <div class="bg-black/40 p-6 rounded-xl border border-gray-800 hover:border-[#D4AF37] transition-all">
                            <div class="text-[#D4AF37] mb-2">
                                <i class="fa-solid fa-scissors text-2xl"></i>
                            </div>
                            <div class="text-3xl font-bold">0</div>
                            <div class="text-gray-500 uppercase text-xs tracking-widest mt-1">Servicios Activos</div>
                        </div>
                        
                        <!-- Stat Card 3 -->
                        <div class="bg-black/40 p-6 rounded-xl border border-gray-800 hover:border-[#D4AF37] transition-all">
                            <div class="text-[#D4AF37] mb-2">
                                <i class="fa-solid fa-user-tie text-2xl"></i>
                            </div>
                            <div class="text-3xl font-bold">0</div>
                            <div class="text-gray-500 uppercase text-xs tracking-widest mt-1">Especialistas</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
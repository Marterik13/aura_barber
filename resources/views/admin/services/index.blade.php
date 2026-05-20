<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl gold-text leading-tight">
            {{ __('Gestión de Servicios') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#1A1A1A] border border-gray-800 overflow-hidden shadow-2xl sm:rounded-3xl">
                <div class="p-8 md:p-12">
                    
                    <div class="flex justify-between items-center mb-8 border-b border-[#333] pb-4">
                        <div>
                            <h3 class="text-3xl font-bold text-white"><i class="fa-solid fa-scissors text-[#D4AF37] mr-3"></i>Catálogo de Servicios</h3>
                            <p class="text-gray-400 mt-2">Administra los servicios que ofreces en Aura Aesthetics.</p>
                        </div>
                        <button style="background: linear-gradient(to right, #BF953F, #FCF6BA, #B38728);" class="text-black font-bold px-6 py-2 rounded-xl shadow-lg hover:scale-105 transition-all flex items-center">
                            <i class="fa-solid fa-plus mr-2"></i> Nuevo Servicio
                        </button>
                    </div>

                    @if($services->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                            @foreach($services as $service)
                                <div style="background-color: rgba(0,0,0,0.4); border: 1px solid #333;" class="p-8 rounded-3xl hover:border-[#D4AF37] transition-all hover:scale-105 hover:shadow-[0_0_15px_rgba(212,175,55,0.15)] flex flex-col justify-between h-full">
                                    <div>
                                        <div class="flex justify-between items-start mb-4">
                                            <h4 class="text-xl font-bold text-white">{{ $service->name }}</h4>
                                            <span style="background-color: rgba(212, 175, 55, 0.1); color: #D4AF37;" class="px-3 py-1 rounded-lg text-xs font-bold uppercase tracking-wider border border-[#D4AF37]/30">
                                                <i class="fa-regular fa-clock mr-1"></i> {{ $service->duration }} min
                                            </span>
                                        </div>
                                        <p class="text-gray-400 text-sm mb-6">{{ $service->description ?? 'Sin descripción detallada.' }}</p>
                                    </div>
                                    
                                    <div class="flex justify-between items-center border-t border-[#333] pt-4 mt-auto">
                                        <div class="text-2xl font-bold text-[#D4AF37]">${{ number_format($service->price, 2) }}</div>
                                        <div class="flex gap-2">
                                            <button style="color: #9ca3af;" class="hover:text-white transition-colors p-2 bg-[#222] rounded-lg hover:bg-[#333]">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                            <button style="color: #ef4444;" class="hover:text-red-400 transition-colors p-2 bg-[#222] rounded-lg hover:bg-[#333]">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="py-16 text-center">
                            <div style="background-color: #111;" class="inline-flex items-center justify-center w-20 h-20 rounded-full mb-4 border border-[#333]">
                                <i class="fa-solid fa-scissors text-4xl text-gray-600"></i>
                            </div>
                            <h4 class="text-xl font-medium text-gray-300">No hay servicios registrados</h4>
                            <p class="text-gray-500 mt-2">Comienza agregando los cortes y tratamientos que ofreces.</p>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-admin-layout>

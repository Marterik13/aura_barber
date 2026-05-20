<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl gold-text leading-tight">
            {{ __('Gestión de Especialistas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#1A1A1A] border border-gray-800 overflow-hidden shadow-2xl sm:rounded-3xl">
                <div class="p-8 md:p-12">
                    
                    <div class="flex justify-between items-center mb-8 border-b border-[#333] pb-4">
                        <div>
                            <h3 class="text-3xl font-bold text-white"><i class="fa-solid fa-user-tie text-[#D4AF37] mr-3"></i>Equipo de Especialistas</h3>
                            <p class="text-gray-400 mt-2">Gestiona a los barberos y estilistas de Aura Aesthetics.</p>
                        </div>
                        <button style="background: linear-gradient(to right, #BF953F, #FCF6BA, #B38728);" class="text-black font-bold px-6 py-2 rounded-xl shadow-lg hover:scale-105 transition-all flex items-center">
                            <i class="fa-solid fa-user-plus mr-2"></i> Nuevo Especialista
                        </button>
                    </div>

                    @if($specialists->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                            @foreach($specialists as $specialist)
                                <div style="background-color: rgba(0,0,0,0.4); border: 1px solid #333;" class="p-8 rounded-3xl hover:border-[#D4AF37] transition-all hover:scale-105 hover:shadow-[0_0_15px_rgba(212,175,55,0.15)] flex flex-col items-center text-center">
                                    
                                    <div class="w-24 h-24 rounded-full border-2 border-[#D4AF37] overflow-hidden mb-4 shadow-[0_0_10px_rgba(212,175,55,0.3)]">
                                        @if($specialist->user->profile_photo_url)
                                            <img src="{{ $specialist->user->profile_photo_url }}" alt="{{ $specialist->user->name }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full bg-[#111] flex items-center justify-center">
                                                <i class="fa-solid fa-user text-3xl text-gray-500"></i>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <h4 class="text-xl font-bold text-white mb-1">{{ $specialist->user->name ?? 'Usuario Eliminado' }}</h4>
                                    
                                    <span style="background-color: rgba(212, 175, 55, 0.1); color: #D4AF37;" class="px-3 py-1 rounded-lg text-xs font-bold uppercase tracking-wider mb-4 border border-[#D4AF37]/30">
                                        {{ $specialist->specialty }}
                                    </span>
                                    
                                    <div class="w-full border-t border-[#333] pt-4 mt-2">
                                        <div class="flex items-center justify-center text-gray-400 text-sm mb-2">
                                            <i class="fa-solid fa-envelope w-5 text-center mr-2 text-[#D4AF37]"></i>
                                            {{ $specialist->user->email ?? 'N/A' }}
                                        </div>
                                        <div class="flex items-center justify-center text-gray-400 text-sm">
                                            <i class="fa-solid fa-phone w-5 text-center mr-2 text-[#D4AF37]"></i>
                                            {{ $specialist->user->phone ?? 'Sin teléfono' }}
                                        </div>
                                    </div>

                                    <div class="flex gap-2 mt-6 w-full justify-center">
                                        <button style="color: #9ca3af;" class="hover:text-white transition-colors p-2.5 bg-[#222] rounded-lg hover:bg-[#333] flex-1 flex justify-center items-center">
                                            <i class="fa-solid fa-pen-to-square mr-2"></i> Editar
                                        </button>
                                        <button style="color: #ef4444;" class="hover:text-red-400 transition-colors p-2.5 bg-[#222] rounded-lg hover:bg-[#333] flex-1 flex justify-center items-center">
                                            <i class="fa-solid fa-trash-can mr-2"></i> Eliminar
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="py-16 text-center">
                            <div style="background-color: #111;" class="inline-flex items-center justify-center w-20 h-20 rounded-full mb-4 border border-[#333]">
                                <i class="fa-solid fa-user-tie text-4xl text-gray-600"></i>
                            </div>
                            <h4 class="text-xl font-medium text-gray-300">No hay especialistas registrados</h4>
                            <p class="text-gray-500 mt-2">Agrega a los miembros de tu equipo para que puedan ser asignados a citas.</p>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-admin-layout>

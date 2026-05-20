<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl gold-text leading-tight">
            {{ __('Gestión de Citas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#1A1A1A] border border-gray-800 overflow-hidden shadow-2xl sm:rounded-3xl">
                <div class="p-8 md:p-12">
                    
                    <div class="flex justify-between items-center mb-8 border-b border-[#333] pb-4">
                        <div>
                            <h3 class="text-3xl font-bold text-white"><i class="fa-solid fa-calendar-check text-[#D4AF37] mr-3"></i>Registro de Citas</h3>
                            <p class="text-gray-400 mt-2">Consulta y administra todas las reservaciones programadas.</p>
                        </div>
                        <a href="{{ route('dashboard') }}" style="background: linear-gradient(to right, #BF953F, #FCF6BA, #B38728);" class="text-black font-bold px-6 py-2 rounded-xl shadow-lg hover:scale-105 transition-all flex items-center">
                            <i class="fa-solid fa-plus mr-2"></i> Agendar Cita
                        </a>
                    </div>

                    @if($appointments->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="border-b-2 border-[#333]">
                                        <th class="py-4 px-4 text-sm font-bold text-[#D4AF37] uppercase tracking-wider">Cliente</th>
                                        <th class="py-4 px-4 text-sm font-bold text-[#D4AF37] uppercase tracking-wider">Servicio</th>
                                        <th class="py-4 px-4 text-sm font-bold text-[#D4AF37] uppercase tracking-wider">Especialista</th>
                                        <th class="py-4 px-4 text-sm font-bold text-[#D4AF37] uppercase tracking-wider">Fecha y Hora</th>
                                        <th class="py-4 px-4 text-sm font-bold text-[#D4AF37] uppercase tracking-wider">Estado</th>
                                        <th class="py-4 px-4 text-sm font-bold text-[#D4AF37] uppercase tracking-wider text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-[#222]">
                                    @foreach($appointments as $appt)
                                        <tr class="hover:bg-[#222] transition-colors">
                                            <td class="py-4 px-4">
                                                <div class="font-bold text-white">{{ $appt->client->name ?? 'N/A' }}</div>
                                                <div class="text-xs text-gray-500">{{ $appt->client->email ?? '' }}</div>
                                            </td>
                                            <td class="py-4 px-4 text-gray-300">
                                                <i class="fa-solid fa-scissors text-[#D4AF37] mr-2 w-4 text-center"></i> {{ $appt->service->name ?? 'N/A' }}
                                            </td>
                                            <td class="py-4 px-4 text-gray-300">
                                                <i class="fa-solid fa-user-tie text-[#D4AF37] mr-2 w-4 text-center"></i> {{ $appt->specialist->user->name ?? 'N/A' }}
                                            </td>
                                            <td class="py-4 px-4">
                                                <div class="text-white font-medium">{{ \Carbon\Carbon::parse($appt->date)->format('d M, Y') }}</div>
                                                <div class="text-xs text-[#D4AF37] font-bold">{{ \Carbon\Carbon::parse($appt->time)->format('h:i A') }}</div>
                                            </td>
                                            <td class="py-4 px-4">
                                                <span style="background-color: rgba(212, 175, 55, 0.1); color: #D4AF37;" class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider border border-[#D4AF37]/30">
                                                    {{ $appt->status }}
                                                </span>
                                            </td>
                                            <td class="py-4 px-4 text-center">
                                                <div class="flex justify-center gap-2">
                                                    <button style="color: #9ca3af;" class="hover:text-white transition-colors p-2 bg-[#111] rounded hover:bg-[#333]" title="Editar">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </button>
                                                    <button style="color: #ef4444;" class="hover:text-red-400 transition-colors p-2 bg-[#111] rounded hover:bg-[#333]" title="Cancelar">
                                                        <i class="fa-solid fa-xmark"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="py-16 text-center">
                            <div style="background-color: #111;" class="inline-flex items-center justify-center w-20 h-20 rounded-full mb-4 border border-[#333]">
                                <i class="fa-regular fa-calendar-xmark text-4xl text-gray-600"></i>
                            </div>
                            <h4 class="text-xl font-medium text-gray-300">No hay citas registradas</h4>
                            <p class="text-gray-500 mt-2">No se encontraron reservaciones en el sistema.</p>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-admin-layout>

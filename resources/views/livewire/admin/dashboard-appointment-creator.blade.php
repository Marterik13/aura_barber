
<div>
    <!-- Botones Principales en el Dashboard -->
    <div class="mt-8 mb-4 flex flex-wrap gap-4">
        <button wire:click="openModal" style="background: linear-gradient(to right, #BF953F, #FCF6BA, #B38728);" class="text-black font-bold px-6 py-3 rounded-xl shadow-lg hover:shadow-xl hover:scale-105 transition-all flex items-center">
            <i class="fa-solid fa-calendar-plus mr-2"></i> Agendar Nueva Cita
        </button>
        
        <button wire:click="openListModal" style="background-color: #1A1A1A; border: 1px solid #D4AF37; color: #D4AF37;" class="font-bold px-6 py-3 rounded-xl shadow-lg hover:shadow-xl hover:bg-[#D4AF37] hover:text-black transition-all flex items-center">
            <i class="fa-solid fa-list mr-2"></i> Ver Citas
        </button>
    </div>

    <!-- Tarjetas de Estadísticas Interactivas -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-8">
        <!-- Stat Card 1 -->
        <div wire:click="openListModal" style="background-color: rgba(0,0,0,0.4); border: 1px solid #333;" class="p-10 rounded-3xl hover:border-[#D4AF37] cursor-pointer transition-all hover:scale-105 hover:shadow-[0_0_15px_rgba(212,175,55,0.2)] flex flex-col items-center justify-center text-center">
            <div class="text-gray-400 uppercase text-sm tracking-widest font-semibold mb-6 border-b border-[#333] pb-4 w-full">Citas Hoy</div>
            <div class="text-[#D4AF37] my-6">
                <i class="fa-solid fa-calendar-check text-5xl"></i>
            </div>
            <div class="text-6xl font-bold text-white mt-2">{{ $citasHoy }}</div>
        </div>
        
        <!-- Stat Card 2 -->
        <div style="background-color: rgba(0,0,0,0.4); border: 1px solid #333;" class="p-10 rounded-3xl hover:border-[#D4AF37] transition-all flex flex-col items-center justify-center text-center">
            <div class="text-gray-400 uppercase text-sm tracking-widest font-semibold mb-6 border-b border-[#333] pb-4 w-full">Servicios Activos</div>
            <div class="text-[#D4AF37] my-6">
                <i class="fa-solid fa-scissors text-5xl"></i>
            </div>
            <div class="text-6xl font-bold text-white mt-2">{{ $totalServicios }}</div>
        </div>
        
        <!-- Stat Card 3 -->
        <div style="background-color: rgba(0,0,0,0.4); border: 1px solid #333;" class="p-10 rounded-3xl hover:border-[#D4AF37] transition-all flex flex-col items-center justify-center text-center">
            <div class="text-gray-400 uppercase text-sm tracking-widest font-semibold mb-6 border-b border-[#333] pb-4 w-full">Especialistas</div>
            <div class="text-[#D4AF37] my-6">
                <i class="fa-solid fa-user-tie text-5xl"></i>
            </div>
            <div class="text-6xl font-bold text-white mt-2">{{ $totalEspecialistas }}</div>
        </div>
    </div>

    <!-- Modal Overlay -->
    @if($showModal)
    <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <!-- Fondo oscuro -->
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-black bg-opacity-75 transition-opacity" aria-hidden="true" wire:click="$set('showModal', false)"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <!-- Contenedor del Modal -->
            <div style="background-color: #1A1A1A; border-color: #333;" class="inline-block align-bottom border rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
                
                <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-2xl font-bold gold-text mb-6 border-b border-[#333] pb-2" id="modal-title">
                        Agendar Cita
                    </h3>
                    
                    <form wire:submit.prevent="save">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            
                            <!-- Cliente -->
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-300 mb-1">Cliente Registrado</label>
                                <div class="flex items-center gap-2">
                                    <select wire:model="client_id" style="background-color: #111; color: #FFF; border-color: #333;" class="w-full border rounded-lg focus:ring-[#D4AF37] focus:border-[#D4AF37] p-2.5" required>
                                        <option value="">Selecciona un cliente...</option>
                                        @foreach($clients as $client)
                                            <option value="{{ $client->id }}">{{ $client->name }} ({{ $client->phone ?? 'Sin teléfono' }})</option>
                                        @endforeach
                                    </select>
                                    
                                    <a href="{{ route('admin.users.create') }}" style="background-color: #222; border: 1px solid #D4AF37; color: #D4AF37;" class="px-4 py-2.5 rounded-lg text-sm font-medium flex items-center shrink-0 transition-all duration-300 hover:opacity-80">
                                        <i class="fa-solid fa-user-plus mr-2"></i> Registrar Nuevo
                                    </a>
                                </div>
                                @error('client_id') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <!-- Especialista -->
                            <div>
    <label class="block text-sm font-medium text-gray-300 mb-1">Especialista</label>
    <select
        id="specialist-select"
        wire:model.live="specialist_id"
        style="background-color: #111; color: #FFF; border-color: #333;"
        class="w-full border rounded-lg p-2.5"
        required
    >
        <option value="">Selecciona un especialista...</option>
        @foreach($specialists as $spec)
            <option value="{{ $spec->id }}">
                {{ $spec->user->name ?? 'Especialista' }} - {{ $spec->specialty }}
            </option>
        @endforeach
    </select>
    @error('specialist_id') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
</div>

                            <!-- Servicio -->
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-1">Servicio</label>
                                <select wire:model="service_id" style="background-color: #111; color: #FFF; border-color: #333;" class="w-full border rounded-lg focus:ring-[#D4AF37] focus:border-[#D4AF37] p-2.5" required>
                                    <option value="">Selecciona un servicio...</option>
                                    @foreach($services as $service)
                                        <option value="{{ $service->id }}">{{ $service->name }} (${{ $service->price }})</option>
                                    @endforeach
                                </select>
                                @error('service_id') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <!-- Fecha -->
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-1">Día de la Cita</label>
                                <input type="date" wire:model="date" style="background-color: #111; color: #FFF; border-color: #333;" class="w-full border rounded-lg focus:ring-[#D4AF37] focus:border-[#D4AF37] p-2.5" required>
                                @error('date') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <!-- Horario -->
                            <!-- Horario -->
<div>
    <label class="block text-sm font-medium text-gray-300 mb-1">Horario</label>
    <select
        id="time-select"
        wire:model="time"
        style="background-color: #111; color: #FFF; border-color: #333;"
        class="w-full border rounded-lg p-2.5"
        required
    >
        <option value="">Selecciona una hora...</option>
        
        <!-- Cambiado de $availableHours a $availableTimes para que coincida con tu backend -->
        @foreach($availableTimes as $hour)
            <option value="{{ $hour }}">{{ $hour }}</option>
        @endforeach
    </select>
    @error('time') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
</div>
                        </div>

                        <!-- Botones de Acción -->
                        <div class="mt-8 flex justify-end gap-3 border-t border-[#333] pt-4">
                            <button type="button" wire:click="$set('showModal', false)" class="px-5 py-2.5 text-sm font-medium text-gray-300 bg-transparent border border-gray-600 rounded-lg hover:bg-gray-800 transition-colors">
                                Cancelar
                            </button>
                            <button type="submit" style="background: linear-gradient(to right, #BF953F, #AA771C);" class="px-5 py-2.5 text-sm font-medium text-black rounded-lg hover:scale-105 transition-all shadow-md">
                                Confirmar Cita
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Modal Overlay de Lista de Citas -->
    @if($showListModal)
    <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-list-title" role="dialog" aria-modal="true">
        <!-- Fondo oscuro -->
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-black bg-opacity-75 transition-opacity" aria-hidden="true" wire:click="$set('showListModal', false)"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <!-- Contenedor del Modal -->
            <div style="background-color: #111; border-color: #333;" class="inline-block align-bottom border rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
                
                <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="flex justify-between items-center mb-6 border-b border-[#333] pb-4">
                        <h3 class="text-2xl font-bold text-[#D4AF37]" id="modal-list-title">
                            <i class="fa-solid fa-calendar-check mr-2"></i> Citas Programadas
                        </h3>
                        <button wire:click="$set('showListModal', false)" style="color: #9ca3af;" class="hover:text-white transition-colors">
                            <i class="fa-solid fa-times text-xl"></i>
                        </button>
                    </div>
                    
                    @if(count($appointmentsList) > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 max-h-[60vh] overflow-y-auto pr-2">
                            @foreach($appointmentsList as $appointment)
        <div style="background-color: #111; border-color: #333;" class="p-4 border rounded-lg text-sm text-gray-300">
            <strong>Fecha:</strong> {{ \Carbon\Carbon::parse($appointment->date)->format('d/m/Y') }} 
            <span class="mx-2 text-gray-600">|</span>
            
            <strong>Hora:</strong> {{ $appointment->time }} 
            <span class="mx-2 text-gray-600">|</span>
            
            <strong>Cliente:</strong> {{ $appointment->client?->name ?? 'N/A' }} 
            <span class="mx-2 text-gray-600">|</span>
            
            <strong>Especialista:</strong> {{ $appointment->specialist?->user?->name ?? 'N/A' }} 
            <span class="mx-2 text-gray-600">|</span>
            
            <strong>Servicio:</strong> {{ $appointment->service?->name ?? 'N/A' }}
            
            <!-- Etiqueta de Estado opcional al final -->
            <span class="ml-4 px-2 py-0.5 rounded text-xs {{ $appointment->status === 'Pending' ? 'bg-yellow-600 text-white' : 'bg-green-600 text-white' }}">
                {{ $appointment->status }}
            </span>
        </div>

    @endforeach
                        </div>
                    @else
                        <div class="py-12 text-center">
                            <div style="background-color: #1A1A1A;" class="inline-flex items-center justify-center w-16 h-16 rounded-full mb-4">
                                <i class="fa-regular fa-calendar-xmark text-3xl text-gray-500"></i>
                            </div>
                            <h4 class="text-lg font-medium text-gray-300">No hay citas programadas</h4>
                            <p class="text-sm text-gray-500 mt-1">Las citas que agendes aparecerán aquí.</p>
                        </div>
                    @endif

                    <!-- Botón de Regresar -->
                    <div class="mt-6 flex justify-end border-t border-[#333] pt-4">
                        <button wire:click="$set('showListModal', false)" style="background-color: #222; border: 1px solid #555; color: #FFF;" class="px-5 py-2.5 rounded-lg text-sm font-medium hover:bg-[#333] transition-colors flex items-center shadow-md">
                            <i class="fa-solid fa-arrow-left mr-2"></i> Regresar al Panel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

<?php

namespace App\Livewire\Admin;

use App\Models\Appointment;
use App\Models\Service;
use App\Models\Specialist;
use App\Models\User;
use Livewire\Component;

class DashboardAppointmentCreator extends Component
{
    public $showModal = false;
    public $showListModal = false;

    public $client_id = '';
    public $specialist_id = '';
    public $service_id = '';
    public $date = '';
    public $time = '';

    public $clients = [];
    public $specialists = [];
    public $services = [];
    public $appointmentsList = [];
    
    public $availableTimes = [];
    
    public $citasHoy = 0;
    public $totalServicios = 0;
    public $totalEspecialistas = 0;

    public function mount()
    {
        $this->clients = User::role('Cliente')->get();
        // Solo obtener especialistas activos
        $this->specialists = Specialist::with('user')->get();
        $this->services = Service::all();
        $this->date = date('Y-m-d');
        
        $this->loadStats();
        $this->updatedDate(); // Generate initial times if specialist is selected (unlikely on mount, but good practice)
    }
    
    public function loadStats()
    {
        if (auth()->user()->hasRole('Administrador')) {
            $this->citasHoy = Appointment::where('date', date('Y-m-d'))->count();
            $this->totalServicios = Service::count();
            $this->totalEspecialistas = Specialist::count();
        } else {
            // Staff sees their own stats
            $specialist = auth()->user()->specialist;
            $this->citasHoy = Appointment::where('date', date('Y-m-d'))->where('specialist_id', $specialist?->id)->count();
            $this->totalServicios = Service::count();
            $this->totalEspecialistas = 1;
        }
    }

    public function openModal()
    {
        $this->clients = User::role('Cliente')->get();
        $this->showListModal = false;
        $this->showModal = true;
        
        // If logged in user is Staff, preselect them
        if (auth()->user()->hasAnyRole(['Estilista', 'Barbero', 'Mixto'])) {
            $specialist = auth()->user()->specialist;
            if ($specialist) {
                $this->specialist_id = $specialist->id;
                $this->updatedSpecialistId();
            }
        }
    }

    public function updatedSpecialistId()
    {
        $this->calculateAvailableTimes();
    }

    public function updatedDate()
    {
        $this->calculateAvailableTimes();
    }

    public function updatedServiceId()
    {
        $this->calculateAvailableTimes();
    }

    public function calculateAvailableTimes()
{
    $this->time = '';
    $this->availableTimes = [];

    if (!$this->specialist_id || !$this->date) {
        return;
    }

    // 1. Buscamos el especialista directo con sus columnas start_time y end_time
    $specialist = \App\Models\Specialist::find($this->specialist_id);

    // Validamos que tenga horas asignadas en la tabla specialists
    if (!$specialist || !$specialist->start_time || !$specialist->end_time) {
        return; 
    }

    $serviceDuration = 30; // por defecto 30 mins
    if ($this->service_id) {
        $service = Service::find($this->service_id);
        if ($service) {
            $serviceDuration = $service->duration;
        }
    }

    // Obtener citas existentes
    $existingAppointments = Appointment::with('service')->where('specialist_id', $this->specialist_id)
        ->where('date', $this->date)
        ->get();

    // 2. Convertimos las horas (ej: 10 y 18) a formato timestamp
    $start = strtotime($this->date . ' ' . $specialist->start_time . ':00');
    $end = strtotime($this->date . ' ' . $specialist->end_time . ':00');

    $times = [];
    $current = $start;

    while ($current + ($serviceDuration * 60) <= $end) {
        $timeString = date('H:i', $current);
        
        $isAvailable = true;

        // Comprobar colisiones con otras citas
        foreach ($existingAppointments as $app) {
            $appStart = strtotime($this->date . ' ' . $app->time);
            $appDuration = $app->service ? $app->service->duration : 30;
            $appEnd = $appStart + ($appDuration * 60);

            $slotStart = $current;
            $slotEnd = $current + ($serviceDuration * 60);

            if ($slotStart < $appEnd && $slotEnd > $appStart) {
                $isAvailable = false;
                break;
            }
        }

        if ($isAvailable) {
            $times[] = $timeString;
        }

        // Bloques de 30 minutos
        $current += 30 * 60;
    }

    $this->availableTimes = $times;
}

    public function openListModal()
{
    $this->showModal = false;
    
    // 1. Iniciamos la consulta base cargando las relaciones
    $query = Appointment::with(['client', 'specialist.user', 'service'])
        ->where('date', '>=', date('Y-m-d'));
        
    $user = auth()->user();

    // 2. Aplicamos los filtros de seguridad según el rol
    if ($user->hasRole('Administrador')) {
        // El administrador ve ABSOLUTAMENTE TODAS las citas
        // No añadimos ningún filtro extra a la consulta
    } 
    elseif ($user->hasAnyRole(['Estilista', 'Barbero', 'Mixto'])) {
        // Si es Especialista/Staff, solo ve las citas donde su ID coincida
        $specialist = $user->specialist;
        if ($specialist) {
            $query->where('specialist_id', $specialist->id);
        } else {
            // Si por algún error no tiene perfil de especialista, no le mostramos nada
            $query->where('id', 0); 
        }
    } 
    else {
        // Si no es admin ni staff, asumimos que es Cliente y solo ve sus propias citas
        $query->where('client_id', $user->id);
    }
        
    // 3. Traemos los resultados ordenados
    $this->appointmentsList = $query->orderBy('date')->orderBy('time')->get();
        
    $this->showListModal = true;
}

    public function save()
    {
        $this->validate([
            'client_id' => 'required|exists:users,id',
            'specialist_id' => 'required|exists:specialists,id',
            'service_id' => 'required|exists:services,id',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|date_format:H:i',
        ]);

        Appointment::create([
            'client_id' => $this->client_id,
            'specialist_id' => $this->specialist_id,
            'service_id' => $this->service_id,
            'date' => $this->date,
            'time' => $this->time,
            'status' => 'Pending',
        ]);

        $this->showModal = false;
        
        $this->reset(['client_id', 'specialist_id', 'service_id', 'time']);
        $this->date = date('Y-m-d');

        session()->flash('swal', [
            'icon'  => 'success',
            'title' => 'Cita Agendada',
            'text'  => 'La cita se ha guardado correctamente.',
        ]);
        
        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.admin.dashboard-appointment-creator');
    }
}

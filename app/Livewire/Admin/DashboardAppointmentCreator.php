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
        $this->clients = User::role('Client')->get();
        // Solo obtener especialistas activos
        $this->specialists = Specialist::with('user')->get();
        $this->services = Service::all();
        $this->date = date('Y-m-d');
        
        $this->loadStats();
        $this->updatedDate(); // Generate initial times if specialist is selected (unlikely on mount, but good practice)
    }
    
    public function loadStats()
    {
        if (auth()->user()->hasRole('Admin')) {
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
        $this->clients = User::role('Client')->get();
        $this->showListModal = false;
        $this->showModal = true;
        
        // If logged in user is Staff, preselect them
        if (auth()->user()->hasRole('Staff')) {
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

        $dayOfWeek = date('w', strtotime($this->date)); // 0 = Sunday, 6 = Saturday

        $schedule = \App\Models\SpecialistSchedule::where('specialist_id', $this->specialist_id)
            ->where('day_of_week', $dayOfWeek)
            ->first();

        if (!$schedule || !$schedule->is_working) {
            return; // No working hours this day
        }

        $serviceDuration = 30; // default 30 mins
        if ($this->service_id) {
            $service = Service::find($this->service_id);
            if ($service) {
                $serviceDuration = $service->duration;
            }
        }

        // Get existing appointments for this specialist on this date
        $existingAppointments = Appointment::with('service')->where('specialist_id', $this->specialist_id)
            ->where('date', $this->date)
            ->get();

        $start = strtotime($this->date . ' ' . $schedule->start_time);
        $end = strtotime($this->date . ' ' . $schedule->end_time);

        $times = [];
        $current = $start;

        while ($current + ($serviceDuration * 60) <= $end) {
            $timeString = date('H:i', $current);
            $endTimeString = date('H:i', $current + ($serviceDuration * 60));
            
            $isAvailable = true;

            // Check against existing appointments
            foreach ($existingAppointments as $app) {
                $appStart = strtotime($this->date . ' ' . $app->time);
                $appDuration = $app->service ? $app->service->duration : 30;
                $appEnd = $appStart + ($appDuration * 60);

                $slotStart = $current;
                $slotEnd = $current + ($serviceDuration * 60);

                // If overlapping
                if ($slotStart < $appEnd && $slotEnd > $appStart) {
                    $isAvailable = false;
                    break;
                }
            }

            if ($isAvailable) {
                $times[] = $timeString;
            }

            // Increment by 30 mins blocks
            $current += 30 * 60;
        }

        $this->availableTimes = $times;
    }

    public function openListModal()
    {
        $this->showModal = false;
        
        $query = Appointment::with(['client', 'specialist.user', 'service'])
            ->where('date', '>=', date('Y-m-d'));
            
        if (auth()->user()->hasRole('Staff')) {
            $specialist = auth()->user()->specialist;
            if ($specialist) {
                $query->where('specialist_id', $specialist->id);
            }
        }
            
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

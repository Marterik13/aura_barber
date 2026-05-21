<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentReminderMail;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Mail\AppointmentConfirmationMail;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    public function index()
    {
        $query = Appointment::with(['client', 'specialist.user', 'service'])->orderBy('date', 'desc')->orderBy('time', 'desc');
        
        if (auth()->user()->hasAnyRole(['Estilista', 'Barbero', 'Mixto'])) {
            $specialist = auth()->user()->specialist;
            if ($specialist) {
                $query->where('specialist_id', $specialist->id);
            }
        }
        
        $appointments = $query->get();
        return view('admin.appointments.index', compact('appointments'));
    }

    public function create()
    {
        $clients = \App\Models\User::all();
        $specialists = \App\Models\Specialist::with('user')->get();
        $services = \App\Models\Service::all();
        return view('admin.appointments.create', compact('clients', 'specialists', 'services'));
    }

    public function store(\Illuminate\Http\Request $request)
    {
        $data = $request->validate([
            'client_id' => 'required|exists:users,id',
            'specialist_id' => 'required|exists:specialists,id',
            'service_id' => 'required|exists:services,id',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'notes' => 'nullable|string',
        ]);

        $data['status'] = 'Pending';

        Appointment::create($data);

        session()->flash('swal', [
            'icon'  => 'success',
            'title' => '¡Bien hecho!',
            'text'  => 'La cita se creó correctamente.',
        ]);

        return redirect()->route('admin.appointments.index');
    }
    public function sendEmail(Appointment $appointment)
{
    $appointment->load([
        'client',
        'specialist.user',
        'service'
    ]);

    Mail::to($appointment->client->email)
    ->queue(new AppointmentConfirmationMail($appointment));

$testReminderTime = now()->addMinute();//$appointmentDateTime->copy()->subHour()


Mail::to($appointment->client->email)
    ->later(
        $testReminderTime,
        new AppointmentConfirmationMail($appointment)
    );
}
}

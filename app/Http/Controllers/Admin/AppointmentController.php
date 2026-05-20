<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;

class AppointmentController extends Controller
{
    public function index()
    {
        $query = Appointment::with(['client', 'specialist.user', 'service'])->orderBy('date', 'desc')->orderBy('time', 'desc');
        
        if (auth()->user()->hasRole('Staff')) {
            $specialist = auth()->user()->specialist;
            if ($specialist) {
                $query->where('specialist_id', $specialist->id);
            }
        }
        
        $appointments = $query->get();
        return view('admin.appointments.index', compact('appointments'));
    }
}

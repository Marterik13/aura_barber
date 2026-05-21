<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Specialist;
use Illuminate\Http\Request;

class SpecialistController extends Controller
{
    public function index()
    {
        $specialists = Specialist::with('user')->get();
        return view('admin.specialists.index', compact('specialists'));
    }

    public function create()
    {
        $users = \App\Models\User::all();
        return view('admin.specialists.create', compact('users'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'specialty' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'start_time' => 'required|integer|min:0|max:23',
            'end_time' => 'required|integer|min:0|max:24|gt:start_time',
        ]);

        Specialist::create($data);

        session()->flash('swal', [
            'icon'  => 'success',
            'title' => '¡Bien hecho!',
            'text'  => 'El especialista se creó correctamente.',
        ]);

        return redirect()->route('admin.specialists.index');
    }

    public function edit(Specialist $specialist)
    {
        $users = \App\Models\User::all();
        return view('admin.specialists.edit', compact('specialist', 'users'));
    }

    public function update(Request $request, Specialist $specialist)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'specialty' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'start_time' => 'required|integer|min:0|max:23',
            'end_time' => 'required|integer|min:0|max:24|gt:start_time',
        ]);

        $specialist->update($data);

        session()->flash('swal', [
            'icon'  => 'success',
            'title' => '¡Actualizado!',
            'text'  => 'El especialista se actualizó correctamente.',
        ]);

        return redirect()->route('admin.specialists.index');
    }

    public function destroy(Specialist $specialist)
    {
        $specialist->delete();

        session()->flash('swal', [
            'icon'  => 'success',
            'title' => 'Eliminado',
            'text'  => 'El especialista ha sido borrado.',
        ]);

        return redirect()->route('admin.specialists.index');
    }

    public function schedules(Specialist $specialist)
    {
        // Authorization: Admin can edit any, Staff can only edit their own
        if (auth()->user()->hasRole('Staff') && auth()->user()->specialist->id !== $specialist->id) {
            abort(403, 'Unauthorized action.');
        }

        $schedules = $specialist->schedules()->orderBy('day_of_week')->get();
        return view('admin.specialists.schedules', compact('specialist', 'schedules'));
    }

    public function updateSchedules(Request $request, Specialist $specialist)
    {
        if (auth()->user()->hasRole('Staff') && auth()->user()->specialist->id !== $specialist->id) {
            abort(403, 'Unauthorized action.');
        }

        $data = $request->validate([
            'schedules' => 'required|array',
            'schedules.*.start_time' => 'required|date_format:H:i',
            'schedules.*.end_time' => 'required|date_format:H:i|after:schedules.*.start_time',
            'schedules.*.is_working' => 'sometimes|boolean',
        ]);

        foreach ($data['schedules'] as $day => $scheduleData) {
            $specialist->schedules()->updateOrCreate(
                ['day_of_week' => $day],
                [
                    'start_time' => $scheduleData['start_time'],
                    'end_time' => $scheduleData['end_time'],
                    'is_working' => isset($scheduleData['is_working']) ? 1 : 0,
                ]
            );
        }

        return redirect()->route('admin.specialists.schedules', $specialist)->with('swal', [
            'icon'  => 'success',
            'title' => 'Horarios Actualizados',
            'text'  => 'Los horarios del especialista se han guardado correctamente.',
        ]);
    }
}

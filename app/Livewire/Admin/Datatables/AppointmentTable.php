<?php

namespace App\Livewire\Admin\Datatables;

use App\Models\Appointment;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class AppointmentTable extends DataTableComponent
{
    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function builder(): Builder
    {
        return Appointment::query()->with(['client', 'specialist.user', 'service']);
    }

    public function columns(): array
    {
        return [
            Column::make("ID", "id")
                ->sortable(),
            Column::make("Cliente", "client.name")
                ->sortable()
                ->searchable(),
            Column::make("Especialista", "specialist.user.name")
                ->sortable()
                ->searchable(),
            Column::make("Servicio", "service.name")
                ->sortable()
                ->searchable(),
            Column::make("Fecha", "date")
                ->sortable(),
            Column::make("Hora", "time")
                ->sortable(),
            Column::make("Estado", "status")
                ->sortable(),
            Column::make("Acciones")
                ->label(function ($row) {
                    return view('admin.appointments.actions', ['appointment' => $row]);
                }),
        ];
    }
}

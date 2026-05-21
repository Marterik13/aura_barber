<?php

namespace App\Livewire\Admin\Datatables;

use App\Models\Specialist;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class SpecialistTable extends DataTableComponent
{
    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function builder(): Builder
{
    return Specialist::query()
        ->select('specialists.*')
        ->with('user');
}

    public function columns(): array
    {
        return [
            Column::make("ID", "id")
                ->sortable(),
            Column::make("Nombre", "user.name")
                ->sortable()
                ->searchable(),
            Column::make("Especialidad", "specialty")
                ->sortable()
                ->searchable(),
            Column::make("Biografía", "bio")
                ->sortable()
                ->searchable()
                ->format(function($value) {
                    return \Illuminate\Support\Str::limit($value, 50);
                }),
            Column::make("Horario", "start_time")
                ->label(function ($row) {

                    return ($row->start_time ?? 'N/A')
                        . ':00 - ' .
                        ($row->end_time ?? 'N/A')
                        . ':00';
                }),
            Column::make("Acciones")
                ->label(function ($row) {
                   return view('admin.specialists.actions', ['specialist' => $row]);
                })
        ];
    }
}

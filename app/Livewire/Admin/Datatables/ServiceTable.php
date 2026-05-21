<?php

namespace App\Livewire\Admin\Datatables;

use App\Models\Service;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class ServiceTable extends DataTableComponent
{
    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function builder(): Builder
    {
        return Service::query();
    }

    public function columns(): array
    {
        return [
            Column::make("ID", "id")
                ->sortable(),
            Column::make("Nombre", "name")
                ->sortable()
                ->searchable(),
            Column::make("Descripción", "description")
                ->sortable()
                ->searchable()
                ->format(function($value) {
                    return \Illuminate\Support\Str::limit($value, 50);
                }),
            Column::make("Precio", "price")
                ->sortable()
                ->format(function($value) {
                    return '$' . number_format($value, 2);
                }),
            Column::make("Duración (min)", "duration")
                ->sortable(),
            Column::make("Acciones")
                ->label(function ($row) {
                   return view('admin.services.actions', ['service' => $row]);
                })
        ];
    }
}

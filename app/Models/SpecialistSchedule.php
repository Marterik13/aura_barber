<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpecialistSchedule extends Model
{
    protected $fillable = [
        'specialist_id',
        'day_of_week',
        'start_time',
        'end_time',
        'is_working',
    ];

    public function specialist()
    {
        return $this->belongsTo(Specialist::class);
    }
}

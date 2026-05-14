<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles; 

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles; 

    

    protected $fillable = [
        'name',
        'email',
        'password',
        'id_number',
        'phone',
        'address',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    protected $appends = [
        'profile_photo_url',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    // Relación para cuando el usuario es un paciente/cliente
    public function patient(){
        return $this->hasOne(Patient::class);
    }

    // Nueva relación para el sistema de estética: Cliente tiene muchas citas
    public function clientAppointments()
    {
        return $this->hasMany(Appointment::class, 'client_id');
    }

    // Si el usuario es un especialista (Staff)
    public function specialist()
    {
        return $this->hasOne(Specialist::class);
    }
}
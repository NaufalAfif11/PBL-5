<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
    'name',
    'email',
    'password',
    'role',
];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function jadwal()
    {
        return $this->hasMany(DokterJadwal::class, 'dokter_id');
    }

    public function vaksins()
    {
        return $this->hasMany(DokterVaksin::class, 'dokter_id');
    }

    public function availabilities()
{
    return $this->hasMany(Availability::class, 'doctor_id');
}

public function Vaksinasis()
{
    return $this->belongsToMany(Vaksinasi::class, 'doctor_vaccine');
}




}

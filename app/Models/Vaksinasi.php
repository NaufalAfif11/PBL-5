<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vaksinasi extends Model
{
    protected $table = 'vaksinasi';

    protected $fillable = [
    'vaccine_name',
    'vaccine_date',
    'vaccine_time', // tambahkan ini
    'address',
    'doctor_name',
    'doctor_email',
    'patient_email',
    'status',
];
public function doctors()
{
    return $this->belongsToMany(User::class, 'doctor_vaccine', 'vaccine_id', 'doctor_id');
}


}


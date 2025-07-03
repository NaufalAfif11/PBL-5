<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vaksinasi extends Model
{
    protected $table = 'vaksinasi';

    protected $fillable = [
        'vaccine_name', 'vaccine_date', 'doctor_name', 'doctor_email',
        'address', 'patient_email', 'status'
    ];
}


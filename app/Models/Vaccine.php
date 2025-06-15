<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vaccine extends Model
{
    protected $fillable = [
    'vaccine_name',
    'doctor_name',
    'vaccine_date',
    'patient_address',
];
//
}

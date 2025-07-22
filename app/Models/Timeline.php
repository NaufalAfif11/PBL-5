<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timeline extends Model
{
    use HasFactory;

    protected $table = 'timeline';

    protected $fillable = [
        'vaccine_name',
        'vaccine_date',
        'vaccine_time',
        'patient_name',
        'patient_email',
        'doctor_name',
        'doctor_email',
        'status',
    ];
}


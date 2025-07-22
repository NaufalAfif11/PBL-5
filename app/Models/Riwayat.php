<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Riwayat extends Model
{
    use HasFactory;

    protected $table = 'riwayat';

    protected $fillable = [
        'vaccine_name',
        'vaccine_date',
        'vaccine_time',
        'doctor_name',
        'status',
    ];
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications'; // pastikan nama tabel sesuai

    protected $fillable = [
    'vaccine_name',
    'vaccine_date',
    'doctor_name',
    'status',
    'user_id', // pastikan ini ada
];

}

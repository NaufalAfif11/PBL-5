<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    public function up()
{
    Schema::create('notifications', function (Blueprint $table) {
        $table->id();
        $table->string('vaccine_name');
        $table->date('vaccine_date');
        $table->string('doctor_name');
        $table->string('status');
        $table->string('queue')->nullable();
        $table->string('address')->nullable();
        $table->string('operational_hours')->nullable();
        $table->timestamps();
    });
}
//
}

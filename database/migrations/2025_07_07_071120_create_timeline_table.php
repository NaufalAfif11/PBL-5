<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimelineTable extends Migration
{
    public function up()
    {
        Schema::create('timeline', function (Blueprint $table) {
            $table->id();
            $table->string('vaccine_name');
            $table->date('vaccine_date');
            $table->time('vaccine_time');
            $table->string('patient_name')->nullable();
            $table->string('patient_email');
            $table->string('doctor_name');
            $table->string('doctor_email');
            $table->enum('status', ['Belum', 'Sudah', 'Dibatalkan'])->default('Belum');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('timeline');
    }
}


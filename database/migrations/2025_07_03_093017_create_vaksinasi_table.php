<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vaksinasi', function (Blueprint $table) {
            $table->id();

            // Wajib diisi sesuai validasi controller
            $table->string('vaccine_name');
            $table->date('vaccine_date');
            $table->string('doctor_name');    // hasil explode[0]
            $table->string('doctor_email');   // hasil explode[1]
            $table->string('address');

            // Otomatis dari user login
            $table->string('patient_email');

            // Status default "Belum", bisa jadi "Sudah" / "Dibatalkan"
            $table->enum('status', ['Belum', 'Sudah', 'Dibatalkan'])->default('Belum');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vaksinasi');
    }
};

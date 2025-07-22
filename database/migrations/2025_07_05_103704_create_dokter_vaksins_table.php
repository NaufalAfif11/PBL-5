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
        // database/migrations/xxxx_create_dokter_vaksins_table.php
Schema::create('dokter_vaksins', function (Blueprint $table) {
    $table->id();
    $table->foreignId('dokter_id')->constrained('users')->onDelete('cascade');
    $table->string('vaccine_name');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokter_vaksins');
    }
};

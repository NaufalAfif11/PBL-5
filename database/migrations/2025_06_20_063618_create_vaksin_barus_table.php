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
        Schema::create('vaksin_barus', function (Blueprint $table) {
            $table->id();
            $table->string('nama_vaksind');
            $table->string('pilfin_vaksin');
            $table->string('nama_dokter');
            $table->date('tanggal_vaksin');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vaksin_barus');
    }
};

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
        Schema::create('detail_vaksinasis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_vaksin');
            $table->date('tanggal_vaksinasi');
            $table->integer('id_antrian');
            $table->string('nama_dokter');
            $table->text('alamat');
            $table->string('status');
            $table->time('jam_operasional');
            $table->text('catatan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_vaksinasis');
    }
};

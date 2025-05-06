<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('vaksins', function (Blueprint $table) {
        $table->id();
        $table->string('nama_vaksin');
        $table->date('tanggal');
        $table->string('nama_dokter');
        $table->text('alamat');
        $table->string('status');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vaksins');
    }
};

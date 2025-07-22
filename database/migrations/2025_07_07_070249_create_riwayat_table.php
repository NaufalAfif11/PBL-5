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
    Schema::create('riwayat', function (Blueprint $table) {
        $table->id();
        $table->string('vaccine_name');
        $table->date('vaccine_date');
        $table->time('vaccine_time');
        $table->string('doctor_name');
        $table->enum('status', ['Sudah', 'Dibatalkan']);
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat');
    }
};

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
    Schema::table('timeline', function (Blueprint $table) {
        $table->unsignedBigInteger('doctor_id')->nullable()->after('id');

        // Jika ingin relasi ke tabel users atau doctors
        // $table->foreign('doctor_id')->references('id')->on('users')->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('timeline', function (Blueprint $table) {
        $table->dropColumn('doctor_id');
    });
}

};

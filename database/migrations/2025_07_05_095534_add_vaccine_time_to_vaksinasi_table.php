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
    Schema::table('vaksinasi', function (Blueprint $table) {
        $table->time('vaccine_time')->after('vaccine_date');
    });
}

public function down()
{
    Schema::table('vaksinasi', function (Blueprint $table) {
        $table->dropColumn('vaccine_time');
    });
}

};

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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // <--- ADD OR ENSURE THIS LINE IS HERE
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->string('username')->nullable(); // <--- ENSURE THIS IS HERE AND NULLABLE IF YOU STILL WANT IT BUT IT'S OPTIONAL
            $table->date('tanggal_lahir')->nullable(); // <--- ENSURE THIS IS HERE IF YOU HAVE IT
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
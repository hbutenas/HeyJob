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
            $table->string('email')->unique();
            $table->enum('type', ['job_seeker', 'employer']);
            $table->string('password')->nullable(); // Make this nullable for social login
            $table->string('provider_id')->nullable(); // To store the social provider user id
            $table->string('provider_name')->nullable(); // To store the name of the social provider
            $table->rememberToken();
            $table->timestamps();
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

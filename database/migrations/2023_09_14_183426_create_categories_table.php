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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->enum('category', [
                'Service industry',
                'Production / Manufacturing',
                'Information technology',
                'Finance / Accounting',
                'Organisation and management',
                'Sales',
                'Administration / Secretarial',
                'Technical Engineering',
                'Transport / Logistics',
                'Banking / Insurance',
                'Trade / Purchase / Supply',
                'Construction / Real estate',
                'Electronics / Telecommunication',
                'Human resources',
                'Energetics / Eletricity',
                'Law / Legal aid',
                'Marketing / Advertising',
                'State and public administration',
                'Health care / Social care',
                'Quality assurance',
                'Tourism, Hotels, Catering',
                'Education / Science',
                'Media / Public relations',
                'Culture / Arts / Entertainment / Sport',
                'Agriculture / Environmnetal services',
                'Pharmacy',
                'Security / Rescue services',
                'Forestry / Woodworking',
                'Third sector / NGO',
                'Temporary / Seasonal',
                'Voluntary job',
                'Other'
            ]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};

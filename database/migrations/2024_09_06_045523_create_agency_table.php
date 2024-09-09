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
        Schema::create('agency', function (Blueprint $table) {
            $table->id();
            $table->string('Agencies'); // Name of the agency
            $table->string('Acronym');  // Acronym for the agency
            $table->string('Agency_Group'); // Group or classification of the agency
            $table->string('Contact'); // Contact information
            $table->string('Website'); // Website URL for the agency
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agency');
    }
};

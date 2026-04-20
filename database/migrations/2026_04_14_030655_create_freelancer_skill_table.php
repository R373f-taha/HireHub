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
        Schema::create('freelancer_skill', function (Blueprint $table) {
            $table->id();
            $table->integer('years_of_experience');
            $table->foreignId('freelancer_id')->constrained('freelancers','id')->onUpdate('cascade');
            $table->foreignId('skill_id')->constrained('skills','id')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('freelancer_skills');
    }
};

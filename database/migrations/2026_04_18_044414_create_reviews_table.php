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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects','id')->unique();
            $table->foreignId('freelancer_id')->constrained('freelancers','id');
            $table->foreignId('client_id')->constrained('clients','id');
            $table->text('comment')->nullable();
            $table->integer('freelancer_rating');
            $table->integer('project_rating');
             $table->index('project_id');
            $table->index('freelancer_id');
             $table->index('client_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};

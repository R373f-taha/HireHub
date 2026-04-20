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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->enum('type_of_balance',['fixed','hourly']);
            $table->enum('project_status',['open','in_progress','closed']);
            $table->json('budget');
            $table->date('deadline');
            $table->foreignId('client_id')->constrained('clients','id')->onDelete('cascade');
             $table->timestamps();
             $table->index('project_status');
             $table->index('client_id');
        });





    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};

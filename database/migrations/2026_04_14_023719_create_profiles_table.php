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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->text('bio');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('image')->nullable();
            $table->string('protofilo_link');
            $table->decimal('hour_rate',10,2);
            $table->string('phone')->nullable();
            $table->json('skills_summery');
            $table->enum('available_mode',['available','not available','busy']);
            $table->foreignId('freelancer_id')->constrained('freelancers','id')->onDelete('cascade')->onUpdate('cascade')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};

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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects','id');
            $table->foreignId('freelancer_id')->constrained('freelancers','id');
            $table->decimal('proposed_amount',10,2);
            $table->text('submission_letter');
            $table->unsignedSmallInteger('delivered_days');
            $table->enum('offer_status',['accepted','rejected','pending']);
            $table->timestamps();
             $table->index('project_id');
            $table->index('freelancer_id');
            $table->index('offer_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};


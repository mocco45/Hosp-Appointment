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
        Schema::create('wards', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('room_number');
            $table->string('type');
            $table->bigInteger('capacity');
            $table->bigInteger('current_patients');
            
            $table->timestamps();
        });

        Schema::create('ward_user', function (Blueprint $table) {
        $table->id();
        $table->foreignId('ward_id')->constrained()->onDelete('cascade');
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->timestamp('admitted_at')->nullable();
        $table->timestamp('discharged_at')->nullable();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wards');
    }
};

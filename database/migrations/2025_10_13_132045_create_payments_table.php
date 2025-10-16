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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constraints('patients')->onDelete('cascade');
            $table->foreignId('appointment_id')->constraints('appointments')->onDelete('cascade');
            $table->bigInteger('amount');
            $table->enum('type',['cash', 'card', 'insurance']);
            $table->enum('status',['pending', 'paid']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};

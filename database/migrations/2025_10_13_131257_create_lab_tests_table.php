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
        Schema::create('lab_tests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constraints('patients')->onDelete('cascade');
            $table->foreignId('doctor_id')->constraints('doctors')->onDelete('cascade');
            $table->foreignId('appointment_id')->constraints('appointments')->onDelete('cascade');
            $table->string('test_type');
            $table->string('results');
            $table->enum('status',['pending','complete',]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lab_tests');
    }
};

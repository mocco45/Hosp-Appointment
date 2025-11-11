<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Doctor;
use App\Models\Patient;

class CreateAppointment extends TestCase
{
   public function setUp(): void
    {
        parent::setUp();

        // Run the seeders before each test
        $this->seed();
    }

    public function a_patient_can_create_appointment(){
        $doctor = Doctor::inRandomOrder()->first();
        $patient = Patient::inRandomOrder()->first();

        $data = [
            'patient_id' => $patient->id,
            'doctor_id' => $doctor->id,
            'date' => now()->addDays(3)->toDateString(),
            'time' => '10:30:00',
            'start_time' => '10:30:00',
            'end_time' => '11:00:00',
            'status' => 'scheduled',
            'reasons' => 'Routine checkup',
        ];

        $response = $this->postJson('/api/create-appointment', $data);

        $response->assertStatus(201)
                ->assertJson([
                    "message" => "Appointment Created Successfully"
                ]);

        $this->assertDatabaseHas('appointments',[
            'patient_id' => $patient->id,
            'doctor_id' => $doctor->id,
        ]);

    }
}

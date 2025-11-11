<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Patient;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(100)->create();
        $patients = User::where('role','patient')->get();
        $doctors = User::where('role','doctor')->get();

        foreach ($patients as $patient) {
            Patient::create([
                'user_id' => $patient->id
            ]);
        }
        foreach ($doctors as $doctor) {
            Doctor::create([
                'user_id' => $doctor->id,
                'speciality' => fake()->randomElement([
                        'General Practitioner',
                        'Cardiologist',
                        'Dermatologist',
                        'Neurologist',
                        'Oncologist',
                        'Pediatrician',
                        'Psychiatrist',
                        'Gynecologist',
                        'Orthopedic Surgeon',
                        'ENT Specialist',
                        'Ophthalmologist',
                        'Radiologist',
                        'Anesthesiologist',
                        'Urologist',
                        'Endocrinologist',
                        'Nephrologist',
                        'Pulmonologist',
                        'Gastroenterologist',
                        'Hematologist',
                        'Rheumatologist',
                        'Pathologist',
                        'Plastic Surgeon',
                        'Infectious Disease Specialist',
                        'Emergency Medicine Specialist',
                        'Family Medicine Physician',
                        'Occupational Therapist',
                        'Physiotherapist',
                        'Dentist',
                        'Chiropractor',
                        'Allergist / Immunologist',
                    ])
                ]);
        }


    }
}

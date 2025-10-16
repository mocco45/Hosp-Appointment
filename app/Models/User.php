<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function doctorAppointments(){
        return $this->hasMany(Appointment::class, 'doctor_id');
    }

    public function patientAppointments(){
        return $this->hasMany(Appointment::class, 'patient_id');
    }

    public function headDepartmentDoctors(){
        return $this->hasMany(Department::class, 'head_doctor_id');
    }

    public function doctorLabResults(){
        return $this->hasMany(LabTest::class, 'doctor_id');
    }

    public function patientLabTests(){
        return $this->hasMany(LabTest::class, 'patient_id');
    }
    public function doctorPatientRecords(){
        return $this->hasMany(MedicalRecord::class, 'doctor_id');
    }

    public function patientMedicalRecords(){
        return $this->hasMany(MedicalRecord::class, 'patient_id');
    }

    public function notifications(){
        return $this->hasMany(Notification::class, 'user_id');
    }

    public function payments(){
        return $this->hasMany(Payment::class, 'patient_id');
    }

    public function doctorPrescriptions(){
        return $this->hasMany(Prescription::class, 'doctor_id');
    }

    public function patientPrescriptions(){
        return $this->hasMany(Prescription::class, 'patient_id');
    }

    public function schedule(){
        return $this->hasMany(Schedule::class, 'user_id');
    }

    public function wards()
    {
        return $this->belongsToMany(Ward::class, 'ward_user')
                    ->withPivot('admitted_at', 'discharged_at')
                    ->withTimestamps();
    }


}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Patient;
use App\Models\Doctor;

class Appointment extends Model
{
    public $table = "appointments";

    protected $fillable = ['patient_id','doctor_id','date','time','start_time','end_time','status','reasons'];

    public function patient(){
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function doctor(){
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function payment(){
        return $this->hasOne(Payment::class);
    }

    public function medicalRecord(){
        return $this->hasOne(MedicalRecord::class);
    }

    public function prescription(){
        return $this->hasOne(Prescription::class);
    }

    public function Notifications(){
        return $this->hasMany(Notification::class);
    }
}

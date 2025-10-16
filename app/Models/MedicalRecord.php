<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    public $table = 'medical_records';

        public function patient(){
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function doctor(){
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function appointment(){
        return $this->belongsTo(Appointment::class, 'medical_record_id');
    }
}

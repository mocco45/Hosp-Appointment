<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    public $table = 'prescriptions';

        public function patient(){
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function doctor(){
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function appointment(){
        return $this->belongsTo(Appointment::class, );
    }
}

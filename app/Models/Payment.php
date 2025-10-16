<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public $table = 'payments';

    public function patient(){
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function appointment(){
        return $this->belongsTo(Appointments::class, 'appointment_id');
    }
}

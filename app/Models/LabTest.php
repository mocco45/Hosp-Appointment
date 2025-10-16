<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LabTest extends Model
{
    public $table = 'lab_tests';

    public function patientLabTest(){
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function doctorLabResult(){
        return $this->belongsTo(User::class, 'doctor_id');
    }
}

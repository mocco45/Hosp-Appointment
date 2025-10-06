<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Patient;
use App\Models\Doctor;

class Appointment extends Model
{
    public $table = "appointments";

    protected $fillable = ['patient_id','doctor_id','date','time','start_time','end_time','status'];

    public function patient(){
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function doctor(){
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }
}

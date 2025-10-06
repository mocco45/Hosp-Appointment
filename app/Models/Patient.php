<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Patient extends Model
{
    public $table = "patients";

    protected $fillable = ['user_id', 'phone', 'gender'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function appointment(){
        return $this->hasMany(Appointment::class, 'doctor_id');
    }
}

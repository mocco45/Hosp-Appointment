<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'departments';

    public function headDoctor()
    {
        return $this->belongsTo(User::class, 'head_doctor_id');
    }

    public function doctors()
    {
        return $this->hasMany(User::class, 'department_id')->where('role', 'doctor');
    }

    public function patients()
    {
        return $this->hasMany(User::class, 'department_id')->where('role', 'patient');
    }

}


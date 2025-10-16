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
}


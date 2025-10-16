<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    public $table = 'wards';

    public function patients()
{
    return $this->belongsToMany(User::class, 'ward_user')
                ->withPivot('admitted_at', 'discharged_at')
                ->withTimestamps();
}

public function appointments()
{
    return $this->hasMany(Appointment::class, 'ward_id');
}

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    public $table = 'notifications';

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function appointmentNotifications(){
        return $this->belongsTo(Appointment::class, 'appointment_id');
    }
}

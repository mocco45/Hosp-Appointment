<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    public $table = "doctors";

    protected $fillable = ['user_id','speciality'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}

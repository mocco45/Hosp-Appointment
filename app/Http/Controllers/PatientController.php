<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function all_patients(){
        $records = User::where('role', 'patient')->get();

        return response()->json($records);
    }

    public function p_schedule(){
        $id = auth()->user()->id;
        $records = Appointment::where('patient_id', $id)->get();

        return response()->json($records);
    }
}

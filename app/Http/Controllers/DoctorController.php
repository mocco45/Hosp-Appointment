<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Appointment;

class DoctorController extends Controller
{
    public function appointment($id){
        $result = Appointment::with(['doctor,doctor.user'])->where('doctor_id',$id)->get();
        return response()->json($result);
    }

    public function schedule($id){
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $weekAppointment = Appointment::with(['doctor,doctor.user'])
                                        ->where('doctor_id', $id)
                                        ->whereBetween('date', [$startOfWeek->toDateString(), $endOfWeek->toDateString()])
                                        ->orderBy('date')
                                        ->orderBy('time')
                                        ->get();

        return response()->json($weekAppointment);
    }

    public function all_docs(){
        $records = User::where('role','doctor')->get();

        return response()->json($records);
    }
}

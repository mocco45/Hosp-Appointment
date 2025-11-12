<?php

namespace App\Services;

use App\Models\Appointment;
use Carbon\Carbon;

class AppointmentService{

    public function store(array $data){
        $startTime = Carbon::parse($data['time']);
        $endTime = $startTime->copy()->addMinutes(30);

        $conflict = Appointment::where('doctor_id', $data['doctor_id'])
                    ->where('date', $data['date'])
                    ->where('start_time', '<', $startTime)
                    ->where('end_time', '>', $endTime)
                    ->exists();

        if($conflict){
            return response()->json(["error" => "This doctor already has another appointment at that time."],409);
        }

        Appointment::create([
            'patient_id' => $data['patient_id'],
            'doctor_id' => $data['doctor_id'],
            'date' => $data['date'],
            'time' => $data['time'],
            'start_time' => $startTime,
            'end_time' => $endTime,
            'status' => $data['status'],
        ]);

        return $data;
    }

    public function confirmAppointments(array $data){

    }

    public function update(array $data, $id){
        $record = Appointment::findOrFail($id);

        $record->update($data);

        return $data;
    }
}

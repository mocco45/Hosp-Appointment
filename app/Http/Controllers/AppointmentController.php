<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Appointment;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    public function index(){
        $record = Appointment::with(['doctor','doctor.user','patient','patient.user'])->get();

        return response()->json($record);
    }

    public function store(Request $request){
        $valid = Validator::make($request->all(), [
            "patient_id" => "required|exists:patients,user_id",
            "doctor_id" => "required|exists:doctors,user_id",
            "date" => "required|date|after_or_equal:today",
            "time" => "required|date_format:H:i",
            "status" => "required|in:pending,complete,cancelled"
        ]);

        if($valid->fails()){
            return response()->json(["error" => $valid->errors()],422);
        }

        $validated = $valid->validated();

        $startTime = Carbon::parse($validated['time']);
        $endTime = $startTime->copy()->addMinutes(30);

        $conflict = Appointment::where('doctor_id', $validated['doctor_id'])
                    ->where('date', $validated['date'])
                    ->where('start_time', '<', $startTime)
                    ->where('end_time', '>', $endTime)
                    ->exists();

        if($conflict){
            return response()->json(["error" => "This doctor already has another appointment at that time."],409);
        }

        Appointment::create([
            'patient_id' => $validated['patient_id'],
            'doctor_id' => $validated['doctor_id'],
            'date' => $validated['date'],
            'time' => $validated['time'],
            'start_time' => $startTime,
            'end_time' => $endTime,
            'status' => $validated['status'],
        ]);

        return response()->json(["message" => "Appointment set successfully"]);

    }


    public function update(Request $request, $id){
        $valid = Validator::make($request->all(), [
            "date" => "nullable|date|after_or_equal:today",
            "time" => "nullable|date_format:H:i",
            "status" => "nullable|in:pending,complete,cancelled"
        ]);

        if($valid->fails()){
            return response()->json(["error" => $valid->errors()],422);
        }

        $validated = $valid->validated();

        $record = Appointment::findOrFail($id);

        $conflict = Appointment::where('doctor_id', $validated['doctor_id'])
                    ->where('date', $validated['date'])
                    ->where('time', $validated['time'])
                    ->where('id', '!=', $validated['id'])
                    ->exists();

        if($conflict){
            return response()->json(["error" => "This doctor already has another appointment at that time."],409);
        }
        $record->update($validated);

        return response()->json(["message" => "Record Updated Succesfully"]);
    }

    public function destroy($id){
        $record = Appointment::findOrFail($id);

        $record->delete();

        return response()->json([
            "message" => "Record Deleted Successfully"
        ]);
    }
}

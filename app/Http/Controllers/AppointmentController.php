<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Appointment;
use App\Http\Requests\Appointment\AppointmentRequest;
use App\Http\Requests\Appointment\UpdateAppointmentRequest;
use App\Services\AppointmentService;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    public function index(){
        $record = Appointment::with(['doctor','doctor','patient','patient'])->get();

        return response()->json($record);
    }

    public function store(AppointmentRequest $request, AppointmentService $service){


        $service->store($request->validated());

        return response()->json(["message" => "Appointment set successfully"]);

    }


    public function update(UpdateAppointmentRequest $request, AppointmentService $service, Appointment $appointment){
        // dd($appointment->id);
        $service->update($request->validated(),$appointment->id);

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

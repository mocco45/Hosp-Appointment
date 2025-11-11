<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Patient;

class UserController extends Controller
{
    public function index(){
        $users = User::all();
        return response()->json($users);
    }

    public function patients(){
        $patients = Patient::with('user')->get();
        return response()->json($patients);
    }

    public function doctors(){
        $doctors = Doctor::with('user')->get();

        return response()->json($doctors);
    }
}

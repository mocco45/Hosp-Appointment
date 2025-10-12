<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Patient;

class AuthController extends Controller
{
    public function index(){
        $users = User::all();
        return response()->json($users);
    }

    public function login(Request $request){
        $valid = Validator::make($request->all(), [
            "email" => "required|email|exists:users,email",
            "password" => "required|string"
        ]);

        if($valid->fails()){
            return response()->json(["error" => $valid->errors()]);
        }

        $validated = $valid->validated();

        $user = User::where("email", $validated["email"])->first();

        if(!$user || !Hash::check($validated["password"], $user->password)){
            return response()->json(["error" => "invalid credentials"]);
        }

        $token = $user->createToken("auth")->plainTextToken;

        return response()->json(["access" => $token, "role" => $user->role]);
    }

    public function register(Request $request){
        $valid = Validator::make($request->all(), [
            "name" => "required|string",
            "email" => "required|email|unique:users,email",
            "password" => "required|string|confirmed",
            "phone" => "required_if:role,patient|numeric|digits_between:10,15",
            "role" => "required|in:admin,patient,doctor,nurse",
            "speciality" => "required_if:role,doctor|string",
            "gender" => "required_if:role,patient|string"
        ]);

        if($valid->fails()){
            return response()->json(["error" => $valid->errors()]);
        }

        $validated = $valid->validated();

        $user = User::create([
            "name" => $validated["name"],
            "email" => $validated["email"],
            "password" => Hash::make($validated["password"]),
            "phone" => $validated["phone"],
            "role" => $validated["role"]
        ]);

        switch ($validated["role"]) {
            case 'doctor':
                Doctor::create([
                    'user_id' => $user->id,
                    'speciality' => $validated['speciality']
                ]);
                break;

            case 'patient':
                Patient::create([
                    'user_id' => $user->id,
                    'gender' => $validated['gender']
                ]);
                break;
        }

        return response()->json(["message" => "Create User Successful"]);
    }

    public function logout(){
        
    }
}

<?php

namespace App\Services;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthService{
    public function login(array $data){
        $user = User::where("email", $data["email"])->first();

        if(!$user || !Hash::check($data["password"], $user->password)){
            throw ValidationException::withMessages([
                'email' => ['Invalid email.'],
                'password' => ['Invalid password.'],
            ]);

        }

        $token = $user->createToken("auth")->plainTextToken;

        return [
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role,
            'token' => $token
        ];

    }

    public function register(array $data){
        $user = User::create([
            "name" => $data["name"],
            "email" => $data["email"],
            "password" => Hash::make($data["password"]),
            "phone" => $data["phone"],
            "role" => $data["role"],
            'gender' => $data['gender']
        ]);

        switch ($data["role"]) {
            case 'doctor':
                Doctor::create([
                    'user_id' => $user->id,
                    'speciality' => $data['speciality']
                ]);
                break;

            case 'patient':
                Patient::create([
                    'user_id' => $user->id,
                ]);
                break;
        }

        return $data;
    }

}

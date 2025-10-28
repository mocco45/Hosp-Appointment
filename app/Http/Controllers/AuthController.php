<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\AuthService;
use App\Services\UserService;

class AuthController extends Controller
{
    public function index(){
        $users = User::all();
        return response()->json($users);
    }

    public function login(LoginRequest $request, AuthService $authService){

        $result = $authService->login($request->validated());

        $userData = [
            'name' => $result['name'],
            'email' => $result['email'],
        ];

        return response()->json(["access" => $token, "role" => $result['role'], "user" => $userData],201);
    }

    public function register(RegisterRequest $request, AuthService $service){
        $service->register($request->validated());

        return response()->json(["message" => "Create User Successful"],201);
    }

    public function logout(){

    }
}

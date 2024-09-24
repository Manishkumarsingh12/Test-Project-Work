<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        $validation = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'email' => 'required',
                'password' => 'required'
            ]
        );

        if ($validation->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation Error !!',
                'error' => $validation
            ], 401);
        }

        $register = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Registration Successfull !!',
            'data' => $register
        ], 200);
    }

    public function login(Request $request)
    {
        // dd($request);
        $validatUser = Validator::make(
            $request->all(),
            [
                'email' => 'required',
                'password' => 'required'
            ]
        );

        if ($validatUser->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation Error !!',
                'error' => $validatUser->errors()->all()
            ], 401);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            return response()->json([
                'status' => true,
                'token' => $user->createToken('api_token')->plainTextToken,
                'token_type' => 'bearer',
                'message' => 'Login Successfull !!',
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Login Failed !!',
                'error' => ['Invalid email or password']
            ], 401);
        }
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();

        return response()->json([
            'status' => true,
            'message' => 'Logout Successfull !!'
        ], 200);
    }


    public function register(Request $request)
    {
        $validation = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6'
            ]
        );

        if ($validation->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation Error',
                'errors' => $validation->errors()
            ], 400);
        }

        $add = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Registration successful!',
            'data' => $add
        ], 201);
    }

    public function registration()
    {
        return view('register');
    }
}
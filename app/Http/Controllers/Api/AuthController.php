<?php

namespace App\Http\Controllers\Api;

use App\Models\Car;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth:api", [
            'except' => [
                "login",
                'register'
            ]
        ]);
    }
    public function register(Request $request)
    {
        $request->validate([
            "name" => 'required',
            "email" => 'required|email',
            "password" => 'required|string|min:8',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // hash the password
        ]);
        UserDetail::create([
            'cin' => $request->cin,
            'address' => $request->address,
            'user_id' => $user->id
        ]);
        $token = Auth::login($user);
        return response()->json([
            "status" => true,
            "message" => "User registered succesfully!",
            "user" => $user,
            "authorization" => [
                "token" => $token,
                "type" => "Bearer",
            ]

        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            "email" => "required",
            "password" => "required",
        ]);
        $credentials = $request->only('email', 'password');
        $token = Auth::attempt($credentials);
        // Attempt to authenticate the user
        if (!$token) {
            return response()->json([
                "status" => "error",
                "message" => "Unauthorized",
            ], 401);
        }
        // Get the authenticated user
        $user = Auth::user();
        // recuperer token by email and password
        // $token = Auth::attempt($request->only('email', ' password '));
        return response()->json([
            "status" => 'success',
            "user" => $user,
            "authorization" => [
                "token" => Auth::tokenById($user->id),
                "type" => "Bearer",
            ]

        ]);
    }
    public function logout()
    {
        Auth::logout();
        return response()->json([
            "status" => true,
            "message" => "User logged out "
        ], 200);
    }
    public function refresh()
    {
        $token = Auth::refresh();
        $user = Auth::user();
        return response()->json([
            "status" => true,
            "message" => "token refreshed",
            "user" => $user,
            "authorization" => [
                "token" => $token,
                "type" => "Bearer",
            ]

        ]);
    }
    public function me()
    {
        $number = Car::count();
        return response()->json([
            "number" => $number,
            "user" => auth()->user()
        ]);
    }

    // public function login(Request $request)
    // {
    //     $request->validate([
    //         "email" => "required",
    //         "password" => "required",
    //     ]);
    //     $credentials = $request->only('name','email', 'password');
    //     $token = Auth::attempt($credentials);
    //    //  dd($token);
    //     if (!$token) {
    //         return response()->json(
    //             [
    //                 "status" => "error",
    //                 'message' => "Login Failed",
    //             ]
    //         );
    //     }
    //     return response()->json([
    //         'status' => 'success',
    //         'message' => 'Logged in succesfully !',
    //         'token' => $token,
    //         'user'=>$credentials
    //     ]);
    // }
}

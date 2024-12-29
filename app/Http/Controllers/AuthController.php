<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(StoreUserRequest $request)
    {
        return User::create($request->all());
    }

    public function login(LoginUserRequest $request)
    {
        if (!Auth::attempt($request->only(['email', 'password']))) {
            return response()->json([
                'message' => 'не правильный email или password ',
            ], 401);
        }

        // $user = Auth::user();
        $user = User::query()->where('email', $request->email)->first();
        $user->tokens()->delete();
        return response()->json([  
            'user' => $user,                                                   
            'token' => $user->createToken(  
                name: "Token of user: {$user->name}",   
                abilities: ['array']  // Замените 'array' на ваши фактические возможности  
            )->plainTextToken,  
        ]); 
    }

    public function logout()
    {
        $user = User::query()->first();
        $user->tokens()->delete();
        return response()->json([
            'message' => 'Токен удалён'
        ]);
    }
}

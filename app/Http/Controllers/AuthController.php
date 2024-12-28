<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(StoreUserRequest $request)
    {
        return 'register';
    }

    public function login(LoginUserRequest $request)
    {
        return 'login';
    }

    public function logout()
    {
        return 'logout';
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Регистрация нового пользователя.
     * @param StoreUserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(StoreUserRequest $request)
    {
        // Создаём нового пользователя с данными из запроса
        $user = User::create($request->all());
        return response()->json($user); // Возвращаем JSON-ответ
    }

    /**
     * Вход пользователя в систему.
     * @param LoginUserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginUserRequest $request)
    {
        // Проверяем, соответствует ли пара email и password
        if (!Auth::attempt($request->only(['email', 'password']))) {
            // Если нет, возвращаем сообщение об ошибке с кодом 401
            return response()->json([
                'message' => 'не правильный email или password ',
            ], 401);
        }

        // Получаем пользователя по email из запроса
        $user = User::query()->where('email', $request->email)->first();
        // Удаляем старые токены пользователя
        $user->tokens()->delete();
        // Возвращаем ответ с пользователем и новым токеном
        return response()->json([
            'user' => $user, // Информация о пользователе
            'token' => $user->createToken(
            "Token of user: {$user->name}" // Имя токена
            )->plainTextToken,
        ]);
    }

    /**
     * Выход пользователя из системы.
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        // Получаем первого пользователя
        $user = User::query()->first();
        // Удаляем все токены пользователя
        $user->tokens()->delete();
        // Возвращаем сообщение об успешном выходе
        return response()->json([
            'message' => 'Токен удалён',
        ]);
    }
}

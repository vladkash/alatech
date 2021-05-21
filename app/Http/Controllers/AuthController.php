<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user = User::query()
            ->where('username', $request->get('username'))
            ->where('password', $request->get('password'))
            ->first();

        if ($user) {

            if ($user->accessToken) {
                return response()->json(['message' => 'Пользователь уже аутентифицирован'], 403);
            } else {
                $token = Str::random(64);

                $user->update(['accessToken' => $token]);

                return response()->json(['token' => $token]);
            }

        } else {
            return response()->json(['message' => 'Неверные учетные данные'], 400);
        }
    }

    public function logout()
    {
        Auth::user()->update(['accessToken' => '']);

        return response()->json(['message' => 'Успешный выход']);
    }

    public function unauthorized()
    {
        return response()->json(['message' => 'Необходима аутентификация'], 401);
    }

    public function forbidden()
    {
        return response()->json(['message' => 'Неверный токен'], 403);
    }
}

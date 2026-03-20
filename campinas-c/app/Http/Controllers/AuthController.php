<?php

namespace App\Http\Controllers;

use App\bases\ApiResponse;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserLoginResource;
use App\Http\Resources\UsersResource;
use App\Models\Users;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $user = Users::where([
            'password_hash' => md5($request->validated('password')),
            'username' => $request->validated('username'),
        ])->first();
        if (!$user) {
            ApiResponse::errorResponse(400, 'Login Failed');
        }
        $token = md5($user->username);
        $token = mb_strtolower($token);
        $user->update([
            'token' => $token,
        ]);
        return ApiResponse::responseDefault(200, [
            'token' => $token,
            'user' => new UserLoginResource($user)
        ]);
    }

    public function register(RegisterRequest $request)
    {
        $password = md5($request->validated('password'));
        $created = Users::create([
            ...$request->validated(),
            'password_hash' => $password,
        ]);
        $created->role = 'user';
        return ApiResponse::responseDefault(201, [
            'user' => new UserLoginResource($created)
        ]);
    }

    public function logout()
    {
        auth()->user()->update([
            'token' => null,
        ]);
        return ApiResponse::response(200, [
            'success' => true
        ]);
        return ['teste' => 'teste'];
    }
}

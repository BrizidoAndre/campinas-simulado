<?php

namespace App\Http\Middleware;

use App\bases\ApiResponse;
use App\Models\Users;
use Closure;
use Illuminate\Http\Request;
use PHPUnit\Metadata\Uses;

class AuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('X-Authorization', false);
        if (!$token) {
            ApiResponse::errorResponse(401, 'Invalid access token');
        }
        $token = str_replace('Bearer ', '', $token);
        $user = Users::where('token', $token)
            ->where('is_banned', 0)
            ->first();
        if (!$user) {
            ApiResponse::errorResponse(401, 'Invalid access token');
        }
        auth()->login($user, false);
        return $next($request);
    }
}

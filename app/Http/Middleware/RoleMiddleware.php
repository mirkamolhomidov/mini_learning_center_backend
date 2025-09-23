<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = $request->user();
        if (!$user) {
            return response()->json([
                'error' => 'Unauthenticated',
                'message' => 'Ro\'yxatdan o\'tmagansiz'
            ], 401);
        }
        $currentToken = $user->currentAccessToken();
        if (!$currentToken) {
            return response()->json([
                'error' => 'Unauthenticated', 
                'message' => 'Ro\'yxatdan o\'tmagansiz'
            ], 401);
        }
        $abilities = $currentToken->abilities ?? [];
        $role = null;
        $userId = null;
        foreach ($abilities as $ability) {
            if (str_starts_with($ability, 'role:')) {
                $role = str_replace('role:', '', $ability);
            }
            if (str_starts_with($ability, 'id:')) {
                $userId = str_replace('id:', '', $ability);
            }
        }
        if (!$role) {
            return response()->json([
                'error' => 'Forbidden',
                'message' => 'Kirish mumkin emas'
            ], 403);
        }
        if (!in_array($role, $roles)) {
            return response()->json([
                'error' => 'Forbidden',
                'message' => 'Kirish mumkin emas'
            ], 403);
        }
        $request->merge(['user_id' => $userId, 'role' => $role]);

        return $next($request);
    }
}
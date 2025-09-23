<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        $tokenRole = $request->user()->currentAccessToken()->abilities;
        $role = null;
        foreach ($tokenRole as $ability) {
            if (str_starts_with($ability, 'role:')) {
                $role = str_replace('role:', '', $ability);
            }
            if (str_starts_with($ability, 'id:')) {
                $userId = str_replace('id:', '', $ability);
            }        
        }    

        if (!$role || !in_array($role, $roles)) {
            return response()->json(['error' => 'Forbidden'], 403);
        }

        $request->merge(['user_id' => $userId]);

        return $next($request);
    }
}

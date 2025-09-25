<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\AuthRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
    
    public function registerForm()
    {
      return view('auth.register');
    }
    public function register(AuthRequest $request)
    {
        $validated = $request->validated();
        $staff = $this->authService->register($validated);

        return response()->json([
            'message' => 'Staff ro‘yxatdan o‘tdi',
            'staff' => $staff,
        ], 201);
    }

    public function login(LoginRequest $request)
    {
        $validated = $request->validated();
        $result = $this->authService->login($validated);
        if (! $result) {
            return response()->json(['message' => 'Login yoki parol xato'], 401);
        }

        return response()->json([
            'message' => 'Muvaffaqiyatli login',
            'staff' => $result['staff'],
            'token' => $result['token'],
        ]);
    }

    public function logout(Request $request)
    {
        $this->authService->logout($request->user());

        return response()->json(['message' => 'Logout qilindi']);
    }
}

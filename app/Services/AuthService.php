<?php

namespace App\Services;

  use App\Models\Staff;
  use Illuminate\Support\Facades\Hash;

  class AuthService
  {
      public function register($data)
      {
          return Staff::create([
              'full_name'    => $data['full_name'],
              'username'     => $data['username'],
              'password'     => Hash::make($data['password']),
              'age'          => $data['age'],
              'phone_number' => $data['phone_number'],
              'role'         => 'staff',
          ]);
      }

      public function login($credentials)
      {
          $staff = Staff::where('username', $credentials['username'])->first();
          if (!$staff || !Hash::check($credentials['password'], $staff->password)) {
              return null;
          }
          $token = $staff->createToken('auth_token', ['id:' . $staff->id, 'role:' . $staff->role])->plainTextToken;
          return [
              'staff' => $staff,
              'token' => $token,
          ];
      }

      public function logout($user)
      {
          $user->currentAccessToken()->delete();
      }
  }

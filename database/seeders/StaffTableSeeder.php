<?php
/* The StaffTableSeeder class is responsible for seeding the staffs table in the database with admin
user data. */

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StaffTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('staffs')->insert([
            'id' => (string) Str::uuid(),
            'full_name' => env('ADMIN_FULL_NAME'),
            'username' => env('ADMIN_USERNAME'),
            'password' => Hash::make(env('ADMIN_PASSWORD')),
            'age' => env('ADMIN_AGE'),
            'phone_number' => env('ADMIN_PHONE_NUMBER'),
            'role' => 'admin'
        ]);
    }
}

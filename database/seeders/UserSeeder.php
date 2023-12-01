<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use File;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get(__DIR__ . "/users.json");
        $users = json_decode($json);

        foreach ($users as $user) {
            User::create([
                'name' => $user->first_name,
                'email' => $user->email,
                'password' => Hash::make($user->password),
                'gender' => $user->gender,
                'mobile' => $user->mobile,
            ]);
        }
    }
}

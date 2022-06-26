<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'general',
                'email' => 'general@example.com',
                'password' => Hash::make('password'),
                'role' => 3,
            ],
            [
                'name' => 'admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('admin0000'),
                'role' => 1,
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}

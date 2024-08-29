<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [

            [
                'name' => 'Manuel',
                'email' => 'manuel@gmail.com',
                'password' => 'password'
            ],

            [
                'name' => 'Chicco',
                'email' => 'chicco@gmail.com',
                'password' => 'password'
            ],

            [
                'name' => 'Pippo',
                'email' => 'pippo@gmail.com',
                'password' => 'password'
            ],

        ];

        foreach ($users as $user) {
            $newUser = new User();
            $newUser->name = $user['name'];
            $newUser->email = $user['email'];
            $newUser->password = $user['password'];
            $newUser->save();
        };
    }
}

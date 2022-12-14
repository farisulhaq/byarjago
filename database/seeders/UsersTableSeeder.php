<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
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
                
                'remember_token'    => NULL,
                'created_at'        => date('Y-m-d h:i:s'),
                'updated_at'        => date('Y-m-d h:i:s'),
            ]
        ];

        $user = User::create([
            'name'              => 'Faris',
            'email'             => 'faris@gmail.com',
            'password'          => Hash::make('Admin@123'),
        ]);
        $user->role_user()->create(['role' => '1']);
    }
}

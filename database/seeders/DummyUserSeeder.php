<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Dummy User Admin',
            'username' => 'admin',
            'role' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
        ]);

        User::create([
            'name' => 'Dummy User Super Admin',
            'username' => 'superadmin',
            'role' => 'superadmin',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('superadmin'),
        ]);

        User::create([
            'name' => 'Dummy User Director',
            'username' => 'director',
            'role' => 'director',
            'email' => 'director@gmail.com',
            'password' => bcrypt('director'),
        ]);
    }
}

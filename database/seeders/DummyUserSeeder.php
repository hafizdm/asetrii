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
            'name' => 'Dummy User',
            'username' => 'admin.b',
            'role' => 'admin',
            'email' => 'admin.b@gmail.com',
            'password' => bcrypt('admin.b'),
        ]);
    }
}

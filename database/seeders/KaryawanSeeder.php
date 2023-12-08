<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('karyawan')->insert([
            'nik' => 'HO202206021',
            'nama_karyawan' => 'Hafizd Muhammad',
            'alamat' => 'Jakarta Selatan',
            'email' => 'hafidz@rapidinfrastruktur.com',
            'no_hp' => '082388455627',
            'agama' => 'Islam',
            'jabatan' => 'IT Support',
            'division' => 'finance and support',
        ]);
    }
}

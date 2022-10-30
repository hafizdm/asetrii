<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

use App\Models\Category;

class DummyCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'label' => 'unit',
                'name' => Str::slug('unit'),
                'group_by'=> 'units',
                'notes' => 'unit',
            ],
            [
                'label' => 'pcs',
                'name' => Str::slug('pcs'),
                'group_by'=> 'units',
                'notes' => 'pcs',
            ],
        ];


        foreach ($data as $key => $value) {
            Category::create($value);
        }
    }
}

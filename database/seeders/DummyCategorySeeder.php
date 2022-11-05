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
        Category::whereNotNull('category_id')->forceDelete();
        $x = Category::all();
    
        foreach ($x as $y) {
            $y->forceDelete();
        }

        $id1 = Str::uuid()->toString();

        $data = [
            [   
                'id' => $id1,
                'label' => 'Laptop',
                'name' => Str::slug('Laptop'),
                'group_by'=> 'kinds',
                'notes' => 'Laptop',
            ],
            [
                'label' => 'Mobil',
                'name' => Str::slug('Mobil'),
                'group_by'=> 'kinds',
                'notes' => 'Mobil',
            ],
            [
                'category_id' => $id1,
                'label' => 'Dell',
                'name' => Str::slug("dell"),
                'group_by'=> 'merks',
                'notes' => 'Dell',
            ],
            [
                'category_id' => $id1,
                'label' => 'Asus',
                'name' => Str::slug("asus"),
                'group_by'=> 'merks',
                'notes' => 'Asus',
            ],
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
            [
                'label' => 'Finance and Support',
                'name' => Str::slug('Finance and Support'),
                'group_by'=> 'divisions',
                'notes' => 'Finance and Support',
            ],
            [
                'label' => 'Operation',
                'name' => Str::slug('Operation'),
                'group_by'=> 'divisions',
                'notes' => 'Operation',
            ],
        ];


        foreach ($data as $key => $value) {
            Category::create($value);
        }
    }
}

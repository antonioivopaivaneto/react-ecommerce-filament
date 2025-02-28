<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name'=> 'Eletronics',
                'department_id'=> 1,
                'parent_id'=> null,
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'=> 'Fashion',
                'department_id'=> 2,
                'parent_id'=> null,
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'=> 'Computers',
                'department_id'=> 1,
                'parent_id'=> 1, //parent eletronics
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'=> 'Smartphones',
                'department_id'=> 1,
                'parent_id'=> 1, //parent eletronics
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'=> 'Laptops',
                'department_id'=> 1,
                'parent_id'=> 3, //parent eletronics
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'=> 'Desktop',
                'department_id'=> 1,
                'parent_id'=> 3, //parent Computers
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'=> 'Android',
                'department_id'=> 1,
                'parent_id'=> 4, //parent smartphones
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('categories')->insert($categories);
    }
}

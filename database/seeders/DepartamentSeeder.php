<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class departments eeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            [
                'name'=> 'Eletronics',
                'slug'=> 'eletronics',
                'active'=> true,
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
            [
                'name'=> 'Fashion',
                'slug'=> 'fashion',
                'active'=> true,
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
            [
                'name'=> 'Home, Garden & Tools',
                'slug'=> Str::slug('home, garden & tools'),
                'active'=> true,
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
            [
                'name'=> 'Book & Audible',
                'slug'=> Str::slug('Books & Audible'),
                'active'=> true,
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
            [
                'name'=> 'Health & Beauty',
                'slug'=> Str::slug('Health & Beauty'),
                'active'=> true,
                'created_at'=> now(),
                'updated_at'=> now(),
            ],

        ];


        DB::table('departments')->insert($departments);
    }
}

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
        DB::table('categories')->insert([
            ['name' => 'Laptop Gaming', 'slug' => 'laptop-gaming'],
            ['name' => 'Laptop Văn phòng', 'slug' => 'laptop-van-phong'],
            ['name' => 'MacBook', 'slug' => 'macbook'],
            ['name' => 'Laptop Đồ họa', 'slug' => 'laptop-do-hoa'],    
            ['name' => 'Phụ kiện', 'slug' => 'phu-kien']
        ]);
    }
}

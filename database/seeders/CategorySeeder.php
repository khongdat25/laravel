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
            ['name' => 'Laptop Gaming'],
            ['name' => 'Laptop Văn phòng'],
            ['name' => 'MacBook'],
            ['name' => 'Laptop Đồ họa'],    
            ['name' => 'Phụ kiện']
        ]);
    }
}

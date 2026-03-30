<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttributeSeeder extends Seeder
{
    public function run(): void
    {
        $attributes = [
            ['name' => 'CPU'],
            ['name' => 'RAM'],
            ['name' => 'VGA'],
            ['name' => 'SSD'],
            ['name' => 'Screen'],
            ['name' => 'OS'],
        ];

        DB::table('attributes')->insert($attributes);
    }
}

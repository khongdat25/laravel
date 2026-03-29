<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->truncate();

        DB::table('users')->insert([
            [
                'name'            => 'Admin',
                'email'           => 'admin@example.com',
                'password'        => Hash::make('password'),
                'phone'           => '0901234567',
                'address'         => '123 Đường Admin, TP.HCM',
                'birthday'        => '1990-01-01',
                'gender'          => 'male',
                'role'            => 'admin',
                'reset_token'     => null,
                'reset_token_exp' => null,
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'name'            => 'Nguyễn Văn A',
                'email'           => 'user@example.com',
                'password'        => Hash::make('password'),
                'phone'           => '0912345678',
                'address'         => '456 Đường User, Hà Nội',
                'birthday'        => '1995-05-15',
                'gender'          => 'female',
                'role'            => 'user',
                'reset_token'     => null,
                'reset_token_exp' => null,
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
        ]);
    }
}

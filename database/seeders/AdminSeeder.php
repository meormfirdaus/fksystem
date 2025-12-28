<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@fkpark.com'],
            ['name' => 'FKPark Admin', 'password' => bcrypt('Admin1234')]
        );

        $admin->assignRole('admin');
    }
}

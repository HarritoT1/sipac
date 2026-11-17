<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->count(10)->unverified()->create([
            'rol_id' => 2
        ]);
        User::factory()->count(10)->create([
            'rol_id' => 3
        ]);
    }
}

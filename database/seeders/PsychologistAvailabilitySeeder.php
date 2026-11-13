<?php

namespace Database\Seeders;

use App\Models\PsychologistAvailability;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PsychologistAvailabilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PsychologistAvailability::factory()->count(30)->create();
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Psychologist;

class PsychologistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

        foreach ($userIds as $userId) {
            Psychologist::Factory()->count(1)->state([
                'user_id' => $userId
            ])->create();
        }
    }
}

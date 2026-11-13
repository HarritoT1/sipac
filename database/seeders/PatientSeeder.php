<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Patient;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = [11, 12, 13, 14, 15, 16, 17, 18, 19, 20];

        foreach ($userIds as $userId) {
            Patient::Factory()->count(1)->state([
                'user_id' => $userId
            ])->create();
        }
    }
}

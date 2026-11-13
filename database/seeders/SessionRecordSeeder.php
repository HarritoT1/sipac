<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Appointment;
use App\Models\SessionRecord;

class SessionRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $appointmentsIds = Appointment::all()->pluck('id');

        foreach ($appointmentsIds as $appointmentId) {
            SessionRecord::factory(1)->state(['appointment_id' => $appointmentId])->create();
        }
    }
}

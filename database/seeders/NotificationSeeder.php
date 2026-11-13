<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Notification;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $appointments = \App\Models\Appointment::all();

        foreach ($appointments as $appointment) {
            Notification::factory()->count(1)->state(['appointment_id' => $appointment->id, 'day_of_notification' => $appointment->scheduled_at->subDay()])->create();
        }
    }
}

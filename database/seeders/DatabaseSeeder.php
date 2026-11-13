<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->truncateTables(['users', 'password_reset_tokens', 'psychologists', 'patients', 'emergency_contacts', 'appointments', 'session_records', 'psychologist_availabilities', 'notifications']);
        //$this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(PasswordResetTokenSeeder::class);
        $this->call(PsychologistSeeder::class);
        $this->call(PatientSeeder::class);
        $this->call(EmergencyContactSeeder::class);
        $this->call(AppointmentSeeder::class);
        $this->call(SessionRecordSeeder::class);
        $this->call(PsychologistAvailabilitySeeder::class);
        $this->call(NotificationSeeder::class);
    }

    public function truncateTables(array $tables)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}

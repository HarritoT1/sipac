<?php

namespace Database\Factories;

use App\Models\Appointment;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Psychologist;
use App\Models\Patient;

/**
 * @extends Factory<Appointment>
 */
class AppointmentFactory extends Factory
{
    protected $model = Appointment::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'scheduled_at' => fake()->dateTimeBetween('now', '+1 month'),
            'duration' => fake()->numberBetween(30, 120),
            'modality' => fake()->randomElement([
                'online',
                'in_person',
            ]),
            'status' => 'scheduled',
            'reason' => fake()->paragraph(),
            'psychologist_id' => Psychologist::query()->inRandomOrder()->first()->id,
            'patient_id' => Patient::query()->inRandomOrder()->first()->id,
        ];
    }
}

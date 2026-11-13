<?php

namespace Database\Factories;

use App\Models\PsychologistAvailability;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PsychologistAvailability>
 */
class PsychologistAvailabilityFactory extends Factory
{
    protected $model = PsychologistAvailability::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'day' => fake()->datetimeBetween('-1 month', '+1 month')->format('Y-m-d'),
            'start_time' => fake()->time('H:i:s'),
            'end_time' => fake()->time('H:i:s'),
            'is_available' => fake()->boolean(),
            'psychologist_id' => \App\Models\Psychologist::query()->inRandomOrder()->first()->id,
        ];
    }
}

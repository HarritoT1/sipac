<?php

namespace Database\Factories;

use App\Models\SessionRecord;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SessionRecord>
 */
class SessionRecordFactory extends Factory
{
    protected $model = SessionRecord::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'diagnosis' => fake()->paragraph(),
            'therapy_notes' => fake()->optional()->paragraph(),
            'clinical_history' => fake()->optional()->paragraph(),
            'treatment' => fake()->optional()->paragraph(),
            'medications' => fake()->optional()->sentence(),
            'psychological_evaluation' => fake()->paragraph(),
            'appointment_id' => null,
        ];
    }
}

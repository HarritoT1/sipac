<?php

namespace Database\Factories;

use App\Models\EmergencyContact;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Patient;

/**
 * @extends Factory<EmergencyContact>
 */
class EmergencyContactFactory extends Factory
{
    protected $model = EmergencyContact::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'relationship' => fake()->randomElement([
                'padre',
                'madre',
                'hermano(a)',
                'tio(a)',
                'primo(a)',
                'amigo(a)',
            ]),
            'phone_number' => fake()->phoneNumber(),
            'email' => fake()->optional()->safeEmail(),
            'is_primary' => fake()->boolean(),
            'patient_id' => Patient::query()->inRandomOrder()->value('id'),
        ];
    }
}

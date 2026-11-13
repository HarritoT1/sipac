<?php

namespace Database\Factories;

use App\Models\Psychologist;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Psychologist>
 */
class PsychologistFactory extends Factory
{
    protected $model = Psychologist::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'professional_license' => fake()->unique()->numerify('###############'),
            'specialty' => implode(',', fake()->randomElements([
                'ansiedad',
                'depresión',
                'terapia de pareja',
                'adolescentes',
                'terapia familiar',
                'duelo',
                'adicciones',
            ], 4)),
            'professional_bio' => fake()->optional()->paragraph(),
            'years_experience' => fake()->numberBetween(0, 50),
            'consultation_fee' => fake()->randomFloat(2, 0, 9999.99),
            'user_id' => null,
        ];
    }
}

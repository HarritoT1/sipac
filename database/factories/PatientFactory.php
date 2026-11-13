<?php

namespace Database\Factories;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Patient>
 */
class PatientFactory extends Factory
{
    protected $model = Patient::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'birth_date' => fake()->date(),
            'gender' => fake()->randomElement([
                'masculino',
                'femenino',
                'no binario',
                'prefiero no decir',
            ]),
            'user_id' => null,
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'full_name' => $this->faker->unique()->name(),
            'name' => $this->faker->unique()->userName(),
            'password' => static::$password ??= Hash::make('password'),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => fake()->dateTimeBetween('-1 month', 'now'),
            'curp' => strtoupper($this->faker->unique()->bothify('????######???????#')),
            'is_active' => $this->faker->boolean(70),
            'is_visible' => $this->faker->boolean(60),
            'phone_number' => $this->faker->unique()->phoneNumber(),
            'home_address' => $this->faker->address(),
            'avatar_url' => 'UploadFiles/default-avatar.png',
            'remember_token' => $this->faker->optional()->uuid(),
            'rol_id' => Role::query()->inRandomOrder()->value('id'),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}

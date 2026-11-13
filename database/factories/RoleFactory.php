<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Role>
 */
class RoleFactory extends Factory
{
    protected $model = Role::class;

    public $privileges = [
        'read',
        'create',
        'update',
        'delete'
    ];
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'rol_name' => $this->faker->unique()->jobTitle(),
            'slug' => $this->faker->unique()->slug(2, false),
            'description' => $this->faker->optional()->paragraph(),
            'privileges' => implode(',', $this->faker->randomElements($this->privileges, 2)),
        ];
    }
}

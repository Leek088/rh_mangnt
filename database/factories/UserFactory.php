<?php

namespace Database\Factories;

use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'department_id' => Department::where('name', 'Administração')->first()->id,
            'name' => 'Administrador',
            'email' => 'admin@rhmangnt.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'role' => 'admin',
            'permissions' => json_encode([
                'create' => true,
                'read' => true,
                'update' => true,
                'delete' => true,
            ]),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

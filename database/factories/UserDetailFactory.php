<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserDetail>
 */
class UserDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::where('email', 'admin@rhmangnt.com')->first()->id,
            'address' => 'Rua do Administrador, 123',
            'zip_code' => '1234-123',
            'city' => 'Lisboa',
            'phone' => '900000001',
            'salary' => 8000.00,
            'admission_date' => '2020-01-01',
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

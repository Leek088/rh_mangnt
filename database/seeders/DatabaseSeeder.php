<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\User;
use App\Models\UserDetail;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Department::factory()->create([
            'name' => 'Administração',
        ]);

        Department::factory()->create([
            'name' => 'Recursos Humanos',
        ]);

        User::factory()->create();

        UserDetail::factory()->create();
    }
}

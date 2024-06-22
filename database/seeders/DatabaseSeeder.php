<?php

namespace Database\Seeders;

use App\Models\UserAuthenticatable;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // UserAuthenticatable::factory(10)->create();

        UserAuthenticatable::factory()->create([
            'name' => 'Test UserAuthenticatable',
            'email' => 'test@example.com',
        ]);
    }
}

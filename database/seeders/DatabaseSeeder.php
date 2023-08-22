<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\Type::factory(10)->create();

        \App\Models\Type::factory()->create([
            'name' => 'Type 1',
            'active' => true
        ]);

        \App\Models\Type::factory()->create([
            'name' => 'Type 2',
            'active' => true
        ]);
    }
}

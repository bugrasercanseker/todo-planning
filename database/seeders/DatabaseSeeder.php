<?php

namespace Database\Seeders;

use App\Models\Developer;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        foreach(range(1,5) as $no) {
            Developer::factory()->create([
               'name' => 'DEV' . $no,
               'level' => $no,
            ]);
        }
    }
}

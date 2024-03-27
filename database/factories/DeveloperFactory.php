<?php

namespace Database\Factories;

use App\Models\Developer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class DeveloperFactory extends Factory
{
    protected $model = Developer::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'level' => $this->faker->numberBetween(1,5),
            'working_hours' => 45,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}

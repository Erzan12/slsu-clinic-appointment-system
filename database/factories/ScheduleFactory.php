<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Schedule>
 */
class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'service_id' => rand(1, 8),
            'specialist_id' => rand(1, 3),
            'time_start' => now()->format('h:i'),
            'time_end' => now()->addHour()->format('h:i'),
            'date' => now()->format('Y-m-d')
        ];
    }
}

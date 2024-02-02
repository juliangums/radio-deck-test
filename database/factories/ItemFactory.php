<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $icons = [
            'heroicon-o-user',
            'heroicon-o-users',
            'heroicon-o-bell',
            'heroicon-o-document',
            'heroicon-o-folder',
            'heroicon-o-calendar',
            'heroicon-o-chart-bar',
            'heroicon-o-cog',
            'heroicon-o-trash',
            'heroicon-o-home',
            'heroicon-o-plus-circle',
            'heroicon-o-pencil',
            'heroicon-o-exclamation',
            'heroicon-o-heart',
            'heroicon-o-paper-clip',
        ];

        return [
            'name' => $this->faker->word,
            'icon' => $this->faker->randomElement($icons),
            'description' => $this->faker->sentence,
        ];
    }
}

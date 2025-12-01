<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Asset>
 */
class AssetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = ['Laptop', 'Desktop'];
        $conditions = ['Excellent', 'Good', 'Fair'];
        $offices = ['Office', 'Kaybiga', 'Agency', 'Operation'];

        return [
            'office' => fake()->randomElement($offices),
            'user' => fake()->name(),
            'type' => $type = fake()->randomElement($types),
            'os' => fake()->randomElement(['Windows 10', 'Windows 11', 'Linux', 'macOS']),
            'processor' => fake()->randomElement([
                'Intel i5-10400', 'Intel i7-12700H', 'Ryzen 5 5600X', 'Ryzen 7 5800H'
            ]),
            'ram' => fake()->randomElement(['8GB', '16GB DDR4', '32GB DDR5']),
            'gpu' => fake()->randomElement([
                'NVIDIA GTX 1650', 'NVIDIA RTX 3060', 'Intel Iris XE', 'AMD Radeon RX 6600'
            ]),
            'condition' => fake()->randomElement($conditions),
        ];
    }
}

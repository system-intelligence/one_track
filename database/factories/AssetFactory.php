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
        $conditions = ['working', 'needs repair', 'broken'];
        $offices = ['Office', 'Kaybiga', 'Agency', 'Operation'];
        $peripheralTypes = ['Mouse', 'Keyboard', 'Printer', 'Speaker', 'Headset'];
        $peripheralConditions = ['working', 'needs repair', 'broken'];

        // Generate 1-4 random peripherals
        $peripherals = [];
        $numPeripherals = fake()->numberBetween(1, 4);

        for ($i = 0; $i < $numPeripherals; $i++) {
            $peripherals[] = [
                'type' => fake()->randomElement($peripheralTypes),
                'details' => fake()->randomElement([
                    'Logitech MX Master 3',
                    'Dell KB216',
                    'HP LaserJet Pro',
                    'JBL Go 3',
                    'Sony WH-1000XM4',
                    'Razer DeathAdder',
                    'Corsair K57',
                    'Epson EcoTank',
                    'Bose SoundLink',
                    'Apple AirPods Pro'
                ]),
                'condition' => fake()->randomElement($peripheralConditions),
            ];
        }

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
            'peripherals' => $peripherals,
        ];
    }
}

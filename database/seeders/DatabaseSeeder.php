<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'admin@example.com',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'), // naka bicrypt para i hash ang password
        ]);


        $this->call(AssetSeeder::class);
    }
}

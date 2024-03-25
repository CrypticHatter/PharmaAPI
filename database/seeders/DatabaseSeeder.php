<?php

namespace Database\Seeders;

use App\Enums\Roles;
use App\Models\Customer;
use App\Models\Medication;
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
        // User::factory()->create([
        //     'name' => 'Test Owner',
        //     'email' => 'owner@example.com',
        //     'role' => 'owner'
        // ]);

        User::factory()
            ->count(3)
            ->sequence(
                ['email' => 'owner@example.com', 'role' => Roles::OWNER],
                ['email' => 'manager@example.com', 'role' => Roles::MANAGER],
                ['email' => 'cashier@example.com', 'role' => Roles::CASHIER],
            )
            ->create();

        Customer::factory(8)->create();
        Medication::factory(10)->create();
    }
}

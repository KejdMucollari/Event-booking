<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Event;
use App\Models\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Run role and admin seeders
        $this->call([
            RoleSeeder::class,
            AdminSeeder::class,
        ]);

        // Get default user role
        $userRole = Role::where('name', 'user')->first();

        // Create random users with 'user' role
        User::factory(6)->create([
            'role_id' => $userRole->id,
        ]);

        // Create a specific test user with 'user' role
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'role_id' => $userRole->id,
        ]);

        // Events
        Event::factory()->count(20)->create();
    }
}

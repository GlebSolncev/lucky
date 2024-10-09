<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create()->each(function ($user) {
            $user->userLink()->create([
                'uuid' => (string) Str::uuid(),
                'expires_at' => now()->addDays(7),
                'active' => true,
            ]);

            Game::factory(5)->create([
                'user_id' => $user->id,
            ]);
        });
    }
}

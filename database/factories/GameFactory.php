<?php

namespace Database\Factories;

use App\Enums\TypeResult;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class GameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $randomNumber = $this->faker->numberBetween(1, 1000);
        $isWin = $randomNumber % 2 === 0;
        $winAmount = $isWin ? $randomNumber * 0.1 : 0; // Simplified for factory

        return [
            'user_id' => User::factory(),
            'number' => $randomNumber,
            'type' => $isWin ? TypeResult::WIN : TypeResult::LOSE,
            'points' => $winAmount,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

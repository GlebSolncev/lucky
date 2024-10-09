<?php

namespace App\Services;

use App\DTO\LuckyResultDto;
use App\Enums\TypeResult;
use App\Models\User;
use App\Repositories\Contracts\LuckyResultRepositoryInterface;
use App\Services\Contracts\GameServiceInterface;

class GameService implements GameServiceInterface
{
    public function __construct(
        protected LuckyResultRepositoryInterface $luckyResultRepository,
    ) {}

    public function play(User $user): LuckyResultDto
    {
        $randomNumber = random_int(1, 1000);
        $isWin = $randomNumber % 2 === 0;
        $type = $isWin ? TypeResult::WIN : TypeResult::LOSE;
        $points = 0.0;

        if ($isWin) {
            if ($randomNumber > 900) {
                $points = $randomNumber * 0.7;
            } elseif ($randomNumber > 600) {
                $points = $randomNumber * 0.5;
            } elseif ($randomNumber > 300) {
                $points = $randomNumber * 0.3;
            } else {
                $points = $randomNumber * 0.1;
            }
        }

        $this->luckyResultRepository->create([
            'user_id' => $user->id,
            'number' => $randomNumber,
            'type' => $type,
            'points' => $points,
        ]);

        return new LuckyResultDto($randomNumber, $type, $points);
    }

    public function getHistory(User $user): array
    {
        $results = $this->luckyResultRepository->getLastResults($user);

        return $results->toArray();
    }
}

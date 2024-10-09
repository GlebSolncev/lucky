<?php

namespace App\Repositories;

use App\Models\Game;
use App\Models\User;
use App\Repositories\Contracts\LuckyResultRepositoryInterface;
use Illuminate\Support\Collection;

class LuckyResultRepository implements LuckyResultRepositoryInterface
{
    public function create(array $data): void
    {
        Game::create($data);
    }

    public function getLastResults(User $user, int $limit = 3): Collection
    {
        return $user->luckyResults()->latest()->take($limit)->get();
    }
}

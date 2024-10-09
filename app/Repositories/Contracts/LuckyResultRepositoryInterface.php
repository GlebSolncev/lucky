<?php

namespace App\Repositories\Contracts;

use App\Models\User;
use Illuminate\Support\Collection;

interface LuckyResultRepositoryInterface
{
    public function create(array $data): void;

    public function getLastResults(User $user, int $limit = 3): Collection;
}

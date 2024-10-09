<?php

namespace App\Services\Contracts;

use App\Dto\LuckyResultDto;
use App\Models\User;

interface GameServiceInterface
{
    public function play(User $user): LuckyResultDto;

    public function getHistory(User $user): array;
}

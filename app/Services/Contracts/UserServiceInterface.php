<?php

namespace App\Services\Contracts;

use App\Models\User;

interface UserServiceInterface
{
    public function register(array $data): User;

    public function generateUniqueLink(User $user): string;

    public function deactivateLink(User $user): void;
}

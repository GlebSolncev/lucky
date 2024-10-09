<?php

namespace App\Repositories\Contracts;

use App\Models\User;

interface UserRepositoryInterface
{
    public function create(array $data): User;

    public function findByLinkUuid(string $uuid): ?User;
}

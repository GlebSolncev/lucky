<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function create(array $data): User
    {
        return User::create($data);
    }

    public function findByLinkUuid(string $uuid): ?User
    {
        return User::whereHas('userLink', function ($query) use ($uuid) {
            $query->where('uuid', $uuid)->where('active', true)->where('expires_at', '>', now());
        })->first();
    }
}

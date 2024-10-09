<?php

namespace App\Repositories;

use App\Models\UserLink;
use App\Repositories\Contracts\UserLinkRepositoryInterface;

class UserLinkRepository implements UserLinkRepositoryInterface
{
    public function create(array $data): UserLink
    {
        return UserLink::create($data);
    }

    public function findActiveByUuid(string $uuid): ?UserLink
    {
        return UserLink::where('uuid', $uuid)
            ->where('active', true)
            ->where('expires_at', '>', now())
            ->first();
    }

    public function deactivate(UserLink $link): void
    {
        $link->update(['active' => false]);
    }
}

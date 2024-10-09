<?php

namespace App\Repositories\Contracts;

use App\Models\UserLink;

interface UserLinkRepositoryInterface
{
    public function create(array $data): UserLink;

    public function findActiveByUuid(string $uuid): ?UserLink;

    public function deactivate(UserLink $link): void;
}

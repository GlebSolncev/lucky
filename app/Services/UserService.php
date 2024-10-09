<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\Contracts\UserLinkRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\Contracts\UserServiceInterface;
use Illuminate\Support\Str;

class UserService implements UserServiceInterface
{
    public function __construct(
        protected UserRepositoryInterface $userRepository,
        protected UserLinkRepositoryInterface $linkRepository
    ) {}

    public function register(array $data): User
    {
        $user = $this->userRepository->create($data);
        $this->generateUniqueLink($user);

        return $user;
    }

    public function generateUniqueLink(User $user): string
    {
        $uuid = (string) Str::uuid();
        $this->linkRepository->create([
            'user_id' => $user->id,
            'uuid' => $uuid,
            'expires_at' => now()->addDays(7),
            'active' => true,
        ]);

        return $uuid;
    }

    public function deactivateLink(User $user): void
    {
        $link = $user->userLink;
        if ($link) {
            $this->linkRepository->deactivate($link);
        }
    }
}

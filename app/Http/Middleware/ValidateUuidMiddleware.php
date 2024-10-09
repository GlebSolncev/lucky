<?php

namespace App\Http\Middleware;

use App\Repositories\Contracts\UserLinkRepositoryInterface;
use Closure;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class ValidateUuidMiddleware
{
    public function __construct(
        protected UserLinkRepositoryInterface $linkRepository
    ) {}

    public function handle(Request $request, Closure $next)
    {
        $uuid = $request->route('uuid');

        if (!$uuid || !Uuid::isValid($uuid)) {
            abort(404, 'UUID wrong.');
        }

        $link = $this->linkRepository->findActiveByUuid($uuid);

        if (!$link) {
            abort(404, 'Link expired.');
        }

        $request->merge([
            'user' => $link->user,
            'uuid' => $uuid,
        ]);

        return $next($request);
    }
}

<?php

namespace App\Providers;

use App\Repositories\Contracts\LuckyResultRepositoryInterface;
use App\Repositories\Contracts\UserLinkRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\LuckyResultRepository;
use App\Repositories\UserLinkRepository;
use App\Repositories\UserRepository;
use App\Services\Contracts\GameServiceInterface;
use App\Services\Contracts\UserServiceInterface;
use App\Services\GameService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(UserLinkRepositoryInterface::class, UserLinkRepository::class);
        $this->app->bind(LuckyResultRepositoryInterface::class, LuckyResultRepository::class);

        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(GameServiceInterface::class, GameService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

<?php

namespace Tests\Unit\Services;

use App\Models\User;
use App\Models\UserLink;
use App\Repositories\UserLinkRepository;
use App\Repositories\UserRepository;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $userRepository;

    protected $userLinkRepository;

    protected $userService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userRepository = $this->app->make(UserRepository::class);
        $this->userLinkRepository = $this->app->make(UserLinkRepository::class);
        $this->userService = new UserService($this->userRepository, $this->userLinkRepository);
    }

    public function testRegisterCreatesUserAndGeneratesUniqueLink()
    {
        $userData = [
            'username' => 'TestUser',
            'phone_number' => '1234567890',
        ];
        $user = $this->userService->register($userData);

        $this->assertInstanceOf(User::class, $user);
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'username' => 'TestUser',
            'phone_number' => '1234567890',
        ]);

        $this->assertNotNull($user->userLink);
        $this->assertTrue($user->userLink->active);
        $this->assertTrue($user->userLink->expires_at->gt(now()));
        $this->assertTrue(Str::isUuid($user->userLink->uuid));

        $anotherUser = $this->userService->register([
            'username' => 'AnotherUser',
            'phone_number' => '0987654321',
        ]);

        $this->assertNotEquals($user->userLink->uuid, $anotherUser->userLink->uuid);
    }

    public function testDeactivateLink()
    {
        $user = User::factory()->create();
        $link = UserLink::factory()->create([
            'user_id' => $user->id,
            'uuid' => Str::uuid(),
            'expires_at' => Carbon::now()->addDays(7),
            'active' => true,
        ]);

        $this->userService->deactivateLink($user);

        $this->assertFalse($link->fresh()->active);
    }

    public function testDeactivateLinkWhenNoActiveLink()
    {
        $user = User::factory()->create();
        $this->userService->deactivateLink($user);
        $this->assertNull($user->userLink);
    }
}

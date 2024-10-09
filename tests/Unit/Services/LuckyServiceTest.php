<?php

namespace Tests\Unit\Services;

use App\DTO\LuckyResultDto;
use App\Enums\TypeResult;
use App\Models\Game;
use App\Models\User;
use App\Repositories\Contracts\LuckyResultRepositoryInterface;
use App\Services\GameService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

class LuckyServiceTest extends TestCase
{
    use RefreshDatabase;

    protected MockInterface $luckyResultRepository;

    protected GameService $luckyService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->luckyResultRepository = Mockery::mock(LuckyResultRepositoryInterface::class);
        $this->luckyService = new GameService($this->luckyResultRepository);

        $this->app->instance(LuckyResultRepositoryInterface::class, $this->luckyResultRepository);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    /**
     * Тестирование метода play при выигрыше.
     *
     * @return void
     */
    public function testPlay()
    {
        $user = User::factory()->create();

        $this->luckyResultRepository->shouldReceive('create')
            ->once();

        $resultDTO = $this->luckyService->play($user);

        $this->assertInstanceOf(LuckyResultDto::class, $resultDTO);
        $this->assertIsInt($resultDTO->randomNumber);
        $this->assertGreaterThanOrEqual(1, $resultDTO->randomNumber);
        $this->assertLessThanOrEqual(1000, $resultDTO->randomNumber);
        $this->assertContains($resultDTO->type, [TypeResult::WIN->label(), TypeResult::LOSE->label()]);
        $this->assertGreaterThanOrEqual(0, $resultDTO->points);
        $this->assertIsFloat($resultDTO->points);
    }

    public function testGetHistory()
    {
        $user = User::factory()->create();

        $luckyResults = Game::factory()->count(5)->create(['user_id' => $user->id]);
        $this->luckyResultRepository->shouldReceive('getLastResults')
            ->once()
            ->andReturn($luckyResults->sortByDesc('created_at')->take(3));
        $history = $this->luckyService->getHistory($user);

        $this->assertIsArray($history);
        $this->assertCount(3, $history);

        foreach ($history as $result) {
            $this->assertArrayHasKey('number', $result);
            $this->assertArrayHasKey('type', $result);
            $this->assertArrayHasKey('points', $result);
        }
    }

    public function testPlayThrowsExceptionOnRepositoryFailure()
    {
        $user = User::factory()->create();
        $this->luckyResultRepository->shouldReceive('create')->once()
            ->andThrow(new \Exception('Database error'));

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Database error');
        $this->luckyService->play($user);
    }
}

<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\Contracts\GameServiceInterface;
use App\Services\Contracts\UserServiceInterface;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(
        protected UserServiceInterface $userService,
        protected GameServiceInterface $gameService
    ) {}

    public function index(Request $request)
    {
        return view('dashboard', [
            'user' => $request->get('user'),
            'uuid' => $request->get('uuid'),
        ]);
    }

    public function generateNewLink(Request $request)
    {
        $user = $request->get('user');

        $this->userService->deactivateLink($user);
        $newUuid = $this->userService->generateUniqueLink($user);

        return redirect()->route('dashboard', ['uuid' => $newUuid]);
    }

    public function deactivateLink(Request $request)
    {
        $user = $request->get('user');

        $this->userService->deactivateLink($user);

        return redirect()->route('register.form');
    }

    public function imFeelingLucky(Request $request)
    {
        $user = $request->get('user');
        $uuid = $request->get('uuid');

        $luckyResult = $this->gameService->play($user);

        return view('lucky', [
            'randomNumber' => $luckyResult->randomNumber,
            'result'       => $luckyResult->type,
            'winAmount'    => $luckyResult->points,
            'uuid'         => $uuid,
        ]);
    }

    public function history(Request $request)
    {
        $user = $request->get('user');
        $uuid = $request->get('uuid');

        $history = $this->gameService->getHistory($user);

        return view('history', compact('history', 'uuid'));
    }
}

<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Services\Contracts\UserServiceInterface;

class RegisterController extends Controller
{
    public function __construct(
        protected UserServiceInterface $userService
    ) {}

    public function showRegistrationForm()
    {
        return view('register');
    }

    public function register(RegisterRequest $request)
    {
        $user = $this->userService->register($request->validated());
        $uuid = $user->userLink->uuid;

        return redirect()->route('dashboard', ['uuid' => $uuid]);
    }
}

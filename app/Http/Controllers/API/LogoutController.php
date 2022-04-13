<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\APIController;
use Illuminate\Auth\AuthManager;

class LogoutController extends APIController
{
    public function __construct(
        private AuthManager $authManager
    ) {}

    public function __invoke()
    {
        if ($this->authManager->check()) {
            $this->authManager->user()->tokens()->delete();
        }

        return $this->success();
    }
}
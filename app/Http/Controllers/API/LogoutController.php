<?php

namespace App\Http\Controllers\API\Users;

use App\Http\Controllers\APIController;
use Illuminate\Auth\AuthManager;

class LogoutController extends APIController
{
    public function __construct(
        private AuthManager $authManager
    ) {}

    public function __invoke()
    {
        $this->authManager->user()->tokens()->delete();

        return $this->success();
    }
}
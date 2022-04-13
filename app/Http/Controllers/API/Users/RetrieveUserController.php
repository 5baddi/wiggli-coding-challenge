<?php

namespace App\Http\Controllers\API\Users;

use App\Http\Controllers\APIController;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Response;

class RetrieveUserController extends APIController
{
    public function __construct(
        private UserService $userService
    ) {}

    public function __invoke(string $id)
    {
        $user = $this->userService->findById($id);
        if (! $user instanceof User) {
            return $this->error(Response::HTTP_NOT_FOUND, 'User not found!');
        }

        return $this->success($user);
    }
}
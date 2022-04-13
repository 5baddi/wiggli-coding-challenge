<?php

namespace App\Http\Controllers\API\Users;

use App\Http\Controllers\APIController;
use App\Services\UserService;
use Illuminate\Http\Request;

class ListUsersController extends APIController
{
    public function __construct(
        private UserService $userService
    ) {}

    public function __invoke(Request $request)
    {
        $users = $this->userService->paginate((int)$request->query('page', 1));

        return $this->success($users);
    }
}
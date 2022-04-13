<?php

namespace App\Http\Controllers\API\Users;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Http\Response;
use App\Http\Controllers\APIController;
use Illuminate\Support\Facades\Validator;

class UpdateUserController extends APIController
{
    public function __construct(
        private UserService $userService
    ) {}

    public function __invoke(int $id, Request $request)
    {
        $user = $this->userService->findById($id);
        if (! $user instanceof User) {
            return $this->error(Response::HTTP_NOT_FOUND, 'User not found!');
        }

        $validator = Validator::make(
            $request->all(),
            [
                User::FIRST_NAME_COLUMN => ['required', 'string', 'min:1'],
                User::LAST_NAME_COLUMN  => ['required', 'string', 'min:1'],
                User::EMAIL_COLUMN      => ['required', 'email'],
                User::PHONE_COLUMN      => ['nullable', 'email'],
                User::AGE_COLUMN        => ['nullable', 'integer'],
                User::TYPE_COLUMN       => ['nullable', 'string'],
            ]
        );

        if ($validator->fails()) {
            return $this->error(Response::HTTP_BAD_REQUEST, 'Invalid user information!', $validator->errors()->toArray());
        }

        $existUser = $this->userService->existsByEmail($user, $request->input(User::EMAIL_COLUMN));
        if ($existUser instanceof User) {
            return $this->error(Response::HTTP_CONFLICT, 'User email already exists!');
        }

        if (! $this->userService->update($user, $validator->validated())) {
            return $this->error(Response::HTTP_CONFLICT, 'Impossible to update user!');
        }

        return $this->success();
    }
}
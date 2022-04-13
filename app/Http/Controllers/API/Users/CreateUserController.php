<?php

namespace App\Http\Controllers\API\Users;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Http\Response;
use App\Http\Controllers\APIController;
use Illuminate\Support\Facades\Validator;

class CreateUserController extends APIController
{
    public function __construct(
        private UserService $userService
    ) {}

    public function __invoke(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                User::FIRST_NAME_COLUMN => ['required', 'string', 'min:1'],
                User::LAST_NAME_COLUMN  => ['required', 'string', 'min:1'],
                User::EMAIL_COLUMN      => ['required', 'email'],
                User::PHONE_COLUMN      => ['nullable', 'string'],
                User::AGE_COLUMN        => ['nullable', 'integer'],
                User::TYPE_COLUMN       => ['nullable', 'string'],
            ]
        );

        if ($validator->fails()) {
            return $this->error(Response::HTTP_BAD_REQUEST, 'Invalid user information!', $validator->errors()->toArray());
        }

        $user = $this->userService->findByEmail($request->input(User::EMAIL_COLUMN));
        if ($user instanceof User) {
            return $this->error(Response::HTTP_CONFLICT, 'User email already exists!');
        }

        $user = $this->userService->create($validator->validated());

        return $this->success($user, Response::HTTP_CREATED);
    }
}
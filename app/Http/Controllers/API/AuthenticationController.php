<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Http\Response;
use App\Http\Controllers\APIController;
use Illuminate\Auth\AuthManager;
use Illuminate\Support\Facades\Validator;

class AuthenticationController extends APIController
{
    public function __construct(
        private UserService $userService,
        private AuthManager $authManager
    ) {}

    public function __invoke(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                User::EMAIL_COLUMN      => ['required', 'email'],
                User::PASSWORD_COLUMN   => ['required', 'string']
            ]
        );

        if ($validator->fails()) {
            return $this->error(Response::HTTP_BAD_REQUEST, 'Invalid user credentials!', $validator->errors()->toArray());
        }

        if (! $this->authManager->attempt($validator->validated())) {
            return $this->error(Response::HTTP_BAD_REQUEST, 'Invalid user credentials!');
        }

        $user = $this->authManager->user();

        return $this->success([
            'token' => $user->createToken('api-auth-token')->accessToken
        ]);
    }
}
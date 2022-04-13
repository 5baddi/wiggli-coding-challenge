<?php

/**
 * Framework
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace App\Services;

use App\Models\User;
use App\Services\Service;
use BADDIServices\Framework\Repositories\UserRepository;
use Illuminate\Support\Arr;
use Illuminate\Hashing\HashManager;

class UserService extends Service
{
    public function __construct(
        private HashManager $hashManager,
        UserRepository $userRepository,
    ) {
        $this->repository = $userRepository;
    }

    public function findById(string $id): ?User
    {
        return $this->repository->findById($id);
    }
    
    public function findByEmail(string $email): ?User
    {
        return $this->repository->findByEmail($email);
    }

    public function create(array $attributes): User
    {
        $attributes = Arr::only(
            $attributes,
            [
                User::FIRST_NAME_COLUMN,
                User::LAST_NAME_COLUMN,
                User::EMAIL_COLUMN,
                User::PASSWORD_COLUMN,
                User::LAST_LOGIN_COLUMN,
                User::LAST_LOGIN_IP_COLUMN,
            ]
        );

        $attributes[User::PASSWORD_COLUMN] = $this->hashManager->make($attributes[User::PASSWORD_COLUMN]);

        return $this->userManager->create($attributes);
    }
    
    public function update(User $user, array $attributes): bool
    {
        $attributes = Arr::only(
            $attributes,
            [
                User::LAST_LOGIN_COLUMN,
                User::LAST_LOGIN_IP_COLUMN,
            ]
        );

        return $this->repository->update([User::ID_COLUMN => $user->getId()], $attributes);
    }
}
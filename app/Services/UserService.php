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
use Illuminate\Pagination\LengthAwarePaginator;

class UserService extends Service
{
    public function __construct(
        private HashManager $hashManager,
        UserRepository $userRepository,
    ) {
        $this->repository = $userRepository;
    }

    public function paginate(?int $page = null): LengthAwarePaginator
    {
        return $this->repository->paginate($page, ['groups']);
    }
    
    public function findById(string $id): ?User
    {
        return $this->repository->findById($id, ['groups']);
    }
    
    public function findByEmail(string $email): ?User
    {
        return $this->repository->findByEmail($email);
    }
    
    public function existsByEmail(User $user, string $email): ?User
    {
        return $this->repository->existsByEmail($user->getId(), $email);
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
                User::PHONE_COLUMN,
                User::AGE_COLUMN,
                User::TYPE_COLUMN,
            ]
        );

        if (Arr::has($attributes, User::PASSWORD_COLUMN)) {
            $attributes[User::PASSWORD_COLUMN] = $this->hashManager->make($attributes[User::PASSWORD_COLUMN]);
        }

        return $this->repository->create($attributes);
    }
    
    public function update(User $user, array $attributes): bool
    {
        $attributes = Arr::only(
            $attributes,
            [
                User::FIRST_NAME_COLUMN,
                User::LAST_NAME_COLUMN,
                User::EMAIL_COLUMN,
                User::PASSWORD_COLUMN,
                User::PHONE_COLUMN,
                User::AGE_COLUMN,
                User::TYPE_COLUMN
            ]
        );
        
        if (Arr::has($attributes, User::PASSWORD_COLUMN)) {
            $attributes[User::PASSWORD_COLUMN] = $this->hashManager->make($attributes[User::PASSWORD_COLUMN]);
        }

        return $this->repository->update([User::ID_COLUMN => $user->getId()], $attributes);
    }

    public function delete(User $user): bool
    {
        return $this->repository->delete($user->getId());
    }
}
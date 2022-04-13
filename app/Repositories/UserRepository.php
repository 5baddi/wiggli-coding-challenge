<?php

/**
 * Framework
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\Framework\Repositories;

use App\Models\User;
use BADDIServices\Framework\Repositories\EloquentRepository;

class UserRepository extends EloquentRepository
{
    /** @var string */
    protected $connection = 'mongodb';

    /** @var User */
    protected $model = User::class;

    public function findById(string $id): ?User
    {
        return $this->newQuery()
            ->find($id);
    }
    
    public function findByEmail(string $email): ?User
    {
        return $this->newQuery()
            ->where(User::EMAIL_COLUMN, $email)
            ->first();
    }

    public function create(array $attributes): User
    {
        return $this->newQuery()->create($attributes);
    }

    public function update(array $conditions, array $attributes): bool
    {
        return $this->newQuery()
            ->where($conditions)
            ->update($attributes);
    }
}
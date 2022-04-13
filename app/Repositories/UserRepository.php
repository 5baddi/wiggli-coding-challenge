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

    public function findByEmail(string $email): ?User
    {
        return $this->first([User::EMAIL_COLUMN => $email]);
    }
    
    public function existsByEmail(int $id, string $email): ?User
    {
        return $this->first([
            [User::ID_COLUMN, '!=', $id],
            [User::EMAIL_COLUMN => $email]
        ]);
    }
}
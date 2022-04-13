<?php

/**
 * Framework
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\Framework\Repositories;

use App\Models\User;
use App\Models\UserGroup;
use BADDIServices\Framework\Repositories\EloquentRepository;

class UserRepository extends EloquentRepository
{
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
            [User::EMAIL_COLUMN, '=', $email]
        ]);
    }
    
    public function attachGroup(string $userId, string $groupId): bool
    {
        return UserGroup::create([
            UserGroup::USER_ID_COLUMN   => $userId,
            UserGroup::GROUP_ID_COLUMN  => $groupId
        ]) instanceof UserGroup;
    }
}
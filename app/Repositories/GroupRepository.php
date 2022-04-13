<?php

/**
 * Framework
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace App\Repositories;

use App\Models\Group;
use BADDIServices\Framework\Repositories\EloquentRepository;

class GroupRepository extends EloquentRepository
{
    /** @var Group */
    protected $model = Group::class;
    
    public function findByName(string $name): ?Group
    {
        return $this->first([Group::NAME_COLUMN => $name]);
    }

    public function existsByName(int $id, string $name): ?Group
    {
        return $this->first([
            [Group::ID_COLUMN, '!=', $id],
            [Group::NAME_COLUMN, '=', $name]
        ]);
    }
}
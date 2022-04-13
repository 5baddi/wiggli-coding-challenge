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
    /** @var string */
    protected $connection = 'mongodb';

    /** @var Group */
    protected $model = Group::class;

    public function findById(string $id): ?Group
    {
        return $this->newQuery()
            ->find($id);
    }
    
    public function findByName(string $name): ?Group
    {
        return $this->newQuery()
            ->where(Group::NAME_COLUMN, $name)
            ->first();
    }

    public function create(array $attributes): Group
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
<?php

/**
 * Framework
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace App\Services;

use App\Models\Group;
use App\Services\Service;
use Illuminate\Support\Arr;
use Illuminate\Hashing\HashManager;
use App\Repositories\GroupRepository;

class GroupService extends Service
{
    public function __construct(
        private HashManager $hashManager,
        GroupRepository $groupRepository,
    ) {
        $this->repository = $groupRepository;
    }

    public function findById(string $id): ?Group
    {
        return $this->repository->findById($id);
    }
    
    public function findByName(string $name): ?Group
    {
        return $this->repository->findByName($name);
    }

    public function create(array $attributes): Group
    {
        $attributes = Arr::only(
            $attributes,
            [
                Group::NAME_COLUMN,
            ]
        );

        return $this->repository->create($attributes);
    }
    
    public function update(Group $group, array $attributes): bool
    {
        $attributes = Arr::only(
            $attributes,
            [
                Group::NAME_COLUMN,
            ]
        );

        return $this->repository->update([Group::ID_COLUMN => $group->getId()], $attributes);
    }
}
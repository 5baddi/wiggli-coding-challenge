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
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class GroupService extends Service
{
    /** @var GroupRepository */
    protected $repository;

    public function __construct(
        private HashManager $hashManager,
        GroupRepository $groupRepository,
    ) {
        $this->repository = $groupRepository;
    }

    public function all(): Collection
    {
        return $this->repository->all();
    }
    
    public function paginate(?int $page = null): LengthAwarePaginator
    {
        return $this->repository->paginate($page, ['user']);
    }

    public function findById(string $id): ?Group
    {
        return $this->repository->findById($id, ['user']);
    }
    
    public function findByName(string $name): ?Group
    {
        return $this->repository->findByName($name);
    }

    public function existsByName(Group $group, string $name): ?Group
    {
        return $this->repository->existsByName($group->getId(), $name);
    }

    public function create(array $attributes): Group
    {
        $attributes = Arr::only(
            $attributes,
            [
                Group::NAME_COLUMN,
                Group::DESCRIPTION_COLUMN,
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
                Group::DESCRIPTION_COLUMN,
            ]
        );

        return $this->repository->update([Group::ID_COLUMN => $group->getId()], $attributes);
    }

    public function delete(Group $group): bool
    {
        return $this->repository->delete($group->getId());
    }
}
<?php

/**
 * Framework
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\Framework\Repositories;

use BADDIServices\Framework\App;
use Illuminate\Database\Eloquent\Collection;
use BADDIServices\Framework\Entities\Entity;
use Illuminate\Pagination\LengthAwarePaginator;
use BADDIServices\Framework\Traits\HasCustomConnection;

abstract class EloquentRepository
{
    use HasCustomConnection;

    public function all(): Collection
    {
        return $this->newQuery()
            ->get();
    }

    public function paginate(?int $page = null, ?int $limit = null): LengthAwarePaginator
    {
        if (is_null($page)) {
            $page = 1;
        }

        if (is_null($limit)) {
            $limit = App::PAGINATION_LIMIT;
        }

        return $this->newQuery()
            ->paginate($limit, ['*'], 'page', $page);
    }

    public function findById(string $id): ?Entity
    {
        return $this->newQuery()
            ->find($id);
    }

    public function first(array $conditions, array $columns = ['*']): ?Entity
    {
        return $this->newQuery()
            ->select($columns)
            ->where($conditions)
            ->first();
    }

    public function where(array $conditions, array $columns = ['*']): Collection
    {
        return $this->newQuery()
            ->select($columns)
            ->where($conditions)
            ->get();
    }

    public function create(array $attributes): Entity
    {
        return $this->newQuery()
            ->create($attributes);
    }
    
    public function update(array $conditions, array $attributes): bool
    {
        return $this->newQuery()
            ->where($conditions)
            ->update($attributes);
    }
    
    public function updateOrCreate(array $conditions, array $attributes): Entity
    {
        return $this->newQuery()
            ->updateOrCreate($conditions, $attributes);
    }
    
    public function delete(string $id): bool
    {
        return $this->newQuery()
            ->where(Entity::ID_COLUMN, $id)
            ->delete() === 1;
    }
}
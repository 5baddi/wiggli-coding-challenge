<?php

/**
 * Framework
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\Framework\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use BADDIServices\Framework\Entities\Entity;

trait HasCustomConnection
{
    /** @var string */
    protected $connection;

    /** @var User|Entity|string */
    protected $model = User::class;

    protected function setConnection(string $name): self
    {
        $this->connection = $name;

        return $this;
    }

    protected function newQuery(): Builder
    {
        if ($this->connection === null) {
            return call_user_func(sprintf('%s::query', $this->model));
        }

        $modelClassName = get_class($this->model);

        return (new $modelClassName)->setConnection($this->connection)->newQuery();
    }
}
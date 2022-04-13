<?php

/**
 * Framework
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace App\Services;

use BADDIServices\Framework\Repositories\UserRepository;
use BADDIServices\Framework\Repositories\EloquentRepository;

abstract class Service 
{
    /** @var UserRepository|EloquentRepository|null */
    protected $repository;
}
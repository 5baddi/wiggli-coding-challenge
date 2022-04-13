<?php

/**
 * Framework
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\Framework\Interfaces;

use Carbon\Carbon;

interface EntityInterface
{
    /** @var string */
    public const ID_COLUMN = 'id';
    public const DELETED_AT_COLUMN = 'deleted_at';

    public function getId(): string;

    public function getDeletedAt(): ?Carbon;
}
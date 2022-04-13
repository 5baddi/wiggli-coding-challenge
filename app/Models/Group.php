<?php

/**
 * Framework
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace App\Models;

use BADDIServices\Framework\Entities\Entity;

class Group extends Entity
{
    /** @var string */
    protected $collection = 'groups';

    public const NAME_COLUMN = 'name';

    public function getName(): string
    {
        return $this->getAttribute(self::NAME_COLUMN);
    }
}
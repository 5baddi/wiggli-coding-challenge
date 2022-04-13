<?php

/**
 * Framework
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace App\Models;

use BADDIServices\Framework\Entities\Entity;

class UserGroup extends Entity
{
    /** @var bool */
    public $timestamps = false;

    public const USER_ID_COLUMN = 'user_id';
    public const GROUP_ID_COLUMN = 'group_id';
}
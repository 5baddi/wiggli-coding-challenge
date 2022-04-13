<?php

/**
 * Framework
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace App\Models;

use BADDIServices\Framework\Entities\Entity;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Group extends Entity
{
    public const NAME_COLUMN = 'name';
    public const DESCRIPTION_COLUMN = 'description';

    public function getName(): string
    {
        return $this->getAttribute(self::NAME_COLUMN);
    }
    
    public function getDescription(): string
    {
        return $this->getAttribute(self::DESCRIPTION_COLUMN);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
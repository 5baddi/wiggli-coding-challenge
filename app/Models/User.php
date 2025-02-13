<?php

/**
 * Framework
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Passwords\CanResetPassword;
use BADDIServices\Framework\Entities\Entity;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Entity implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
    use Notifiable, Authenticatable, Authorizable, CanResetPassword, MustVerifyEmail, HasApiTokens;

    public const FIRST_NAME_COLUMN = 'first_name';
    public const LAST_NAME_COLUMN = 'last_name';
    public const EMAIL_COLUMN = 'email';
    public const PASSWORD_COLUMN = 'password';
    public const PHONE_COLUMN = 'phone';
    public const VERIFIED_AT_COLUMN = 'verified_at';
    public const AGE_COLUMN = 'age';
    public const TYPE_COLUMN = 'type';

    /** @var array */
    protected $hidden = [
        self::PASSWORD_COLUMN,
    ];
    
    public function getFirstName(): string
    {
        return ucwords($this->getAttribute(self::FIRST_NAME_COLUMN));
    }
    
    public function getLastName(): string
    {
        return ucwords($this->getAttribute(self::LAST_NAME_COLUMN));
    }
    
    public function getEmail(): string
    {
        return $this->getAttribute(self::EMAIL_COLUMN);
    }
    
    public function getPassword(): ?string
    {
        return $this->getAttribute(self::PASSWORD_COLUMN);
    }
    
    public function getPhone(): ?string
    {
        return $this->getAttribute(self::PHONE_COLUMN);
    }
    
    public function getType(): ?string
    {
        return $this->getAttribute(self::TYPE_COLUMN);
    }
    
    public function getAge(): ?int
    {
        return $this->getAttribute(self::AGE_COLUMN);
    }

    public function getFullName(): string
    {
        return sprintf('%s %s', $this->getFirstName(), $this->getLastName());
    }

    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(Group::class, 'user_groups');
    }
}
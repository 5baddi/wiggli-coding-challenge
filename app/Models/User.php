<?php

/**
 * Framework
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace App\Models;

use BADDIServices\Framework\Entities\Entity;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Laravel\Sanctum\HasApiTokens;

class User extends Entity implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
    use Notifiable, Authenticatable, Authorizable, CanResetPassword, MustVerifyEmail, HasApiTokens;

    /** @var string */
    protected $collection = 'users';

    public const FIRST_NAME_COLUMN = 'first_name';
    public const LAST_NAME_COLUMN = 'last_name';
    public const EMAIL_COLUMN = 'email';
    public const PASSWORD_COLUMN = 'password';
    public const PHONE_COLUMN = 'phone';
    public const VERIFIED_AT_COLUMN = 'verified_at';
    public const IS_SUPER_ADMIN_COLUMN = 'is_super_admin';
    public const AGE_COLUMN = 'age';
    public const TYPE_COLUMN = 'type';
    public const GROUPS_COLUMN = 'groups';

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
    
    public function getGroups(): ?array
    {
        if (! is_null($this->getAttribute(self::GROUPS_COLUMN))) {
            return json_decode($this->getAttribute(self::GROUPS_COLUMN));
        }

        return [];
    }

    public function getFullName(): string
    {
        return sprintf('%s %s', $this->getFirstName(), $this->getLastName());
    }
}
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
    public const AVATAR_COLUMN = 'avatar';
    public const EMAIL_COLUMN = 'email';
    public const PASSWORD_COLUMN = 'password';
    public const PHONE_COLUMN = 'phone';
    public const VERIFIED_AT_COLUMN = 'verified_at';
    public const LAST_LOGIN_COLUMN = 'last_login';
    public const LAST_LOGIN_IP_COLUMN = 'last_login_ip';
    public const TIMEZONE_COLUMN = 'timezone';
    public const BANNED_COLUMN = 'banned';
    public const IS_SUPER_ADMIN_COLUMN = 'is_super_admin';

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
    
    public function getAvatar(): ?string
    {
        return $this->getAttribute(self::AVATAR_COLUMN);
    }
    
    public function getPhone(): ?string
    {
        return $this->getAttribute(self::PHONE_COLUMN);
    }
    
    public function hasPassword(): bool
    {
        return $this->getAttribute(self::PASSWORD_COLUMN) !== null;
    }

    public function getFullName(): string
    {
        return sprintf('%s %s', $this->getFirstName(), $this->getLastName());
    }
}
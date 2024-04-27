<?php

namespace App\Enums;

enum UserStatus: string
{
    use EnumTrait;
    case ADMIN = 'admin';
    case USER = 'user';

    public function title(): string
    {
        return match ($this) {
            self::ADMIN => 'admin',
            self::USER => 'user',
        };
    }
}

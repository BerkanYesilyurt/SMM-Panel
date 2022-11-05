<?php

namespace App\Enums;

enum UserStatusEnum:int {
    case ACTIVE = 1;
    case BANNED = 2; //this option is planned for temporary restrictions.
    case CLOSED = 3;

    public static function values(): array
    {
        return array_column(self::cases(), 'name', 'value');
    }
}

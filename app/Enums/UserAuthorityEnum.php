<?php

namespace App\Enums;

enum UserAuthorityEnum:int {
    case none = 0;
    case support = 1;
    case admin = 2;

    public static function values(): array
    {
        return array_column(self::cases(), 'name', 'value');
    }
}

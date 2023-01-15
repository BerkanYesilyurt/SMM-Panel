<?php

namespace App\Enums;

enum ActiveInactiveState:int {
    case INACTIVE = 0;
    case ACTIVE = 1;

    public static function values(): array
    {
        return array_column(self::cases(), 'name', 'value');
    }
}

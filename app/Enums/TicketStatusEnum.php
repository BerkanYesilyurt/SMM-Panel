<?php

namespace App\Enums;

enum TicketStatusEnum:int {
    case CLOSED = 0;
    case ACTIVE = 1;

    public static function values(): array
    {
        return array_column(self::cases(), 'name', 'value');
    }
}

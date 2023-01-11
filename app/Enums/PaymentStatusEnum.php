<?php

namespace App\Enums;

enum PaymentStatusEnum:int {

    case CANCELED = 0;
    case PENDING = 1;
    case COMPLETED = 2;

    public static function values(): array
    {
        return array_column(self::cases(), 'name', 'value');
    }
}

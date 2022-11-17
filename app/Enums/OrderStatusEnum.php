<?php

namespace App\Enums;

enum OrderStatusEnum:int {
    case PENDING = 0;
    case PROCESSING = 1;
    case INPROGRESS = 2;
    case COMPLETED = 3;
    case PARTIAL = 4;
    case CANCELED = 5;


    public static function values(): array
    {
        return array_column(self::cases(), 'name', 'value');
    }
}

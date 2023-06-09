<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum OrderStatusEnum:int {
    use EnumTrait;

    case PENDING = 0;
    case PROCESSING = 1;
    case INPROGRESS = 2;
    case COMPLETED = 3;
    case PARTIAL = 4;
    case CANCELED = 5;
}

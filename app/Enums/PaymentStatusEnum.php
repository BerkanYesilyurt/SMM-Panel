<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum PaymentStatusEnum:int {
    use EnumTrait;

    case CANCELED = 0;
    case PENDING = 1;
    case COMPLETED = 2;
}

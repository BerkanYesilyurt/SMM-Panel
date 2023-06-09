<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum TicketStatusEnum:int {
    use EnumTrait;

    case CLOSED = 0;
    case ACTIVE = 1;
}

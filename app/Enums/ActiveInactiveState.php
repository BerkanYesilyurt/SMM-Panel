<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum ActiveInactiveState:int {
    use EnumTrait;

    case INACTIVE = 0;
    case ACTIVE = 1;
}

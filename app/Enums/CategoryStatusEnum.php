<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum CategoryStatusEnum:int {
    use EnumTrait;

    case INACTIVE = 0;
    case ACTIVE = 1;
}

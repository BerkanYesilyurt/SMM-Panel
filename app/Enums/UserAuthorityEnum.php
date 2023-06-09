<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum UserAuthorityEnum:int {
    use EnumTrait;

    case none = 0;
    case support = 1;
    case admin = 2;
}

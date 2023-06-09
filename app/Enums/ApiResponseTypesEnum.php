<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum ApiResponseTypesEnum:int {
    use EnumTrait;

    case APIBALANCE = 1;
    case ORDER = 10;
    case ORDERSTATUS = 11;
}

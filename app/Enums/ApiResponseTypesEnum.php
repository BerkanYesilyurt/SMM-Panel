<?php

namespace App\Enums;

enum ApiResponseTypesEnum:int {
    case APIBALANCE = 1;
    case ORDER = 10;
    case ORDERSTATUS = 11;
}

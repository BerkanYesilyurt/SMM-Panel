<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum UserBanTypesEnum: string
{
    use EnumTrait;

    case ticket = 'ticket';
    case account = 'account';
}

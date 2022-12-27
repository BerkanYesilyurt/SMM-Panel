<?php

namespace App\Enums;

enum UserBanTypesEnum: string
{
    case ticket = 'ticket';
    case account = 'account';

    public static function values(): array
    {
        return array_column(self::cases(), 'name', 'value');
    }
}

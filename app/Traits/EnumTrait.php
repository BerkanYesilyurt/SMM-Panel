<?php

namespace App\Traits;

trait EnumTrait {

    public static function values(): array
    {
        return array_column(self::cases(), 'name', 'value');
    }

    public static function getOnlyValues(): \Illuminate\Support\Collection
    {
        return collect(self::cases())->pluck('value');
    }

    public static function getOnlyNames($lowerCase = false): \Illuminate\Support\Collection
    {
        $namesCollection = collect(self::cases())->pluck('name');
        return $lowerCase
            ? $namesCollection->map(fn ($name) => strtolower($name))
            : $namesCollection;
    }
}

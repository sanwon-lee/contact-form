<?php

namespace App\Enums;

enum Gender: int
{
    case MALE   = 1;
    case FEMALE = 2;
    case OTHER  = 3;
    public function label(): string
    {
        return match ($this) {
            self::MALE   => '男性',
            self::FEMALE => '女性',
            self::OTHER  => 'その他',
        };
    }


    public static function options(): array
    {
        return collect(self::cases())
            ->pluck('name', 'value')
            ->mapWithKeys(fn($name, $value) => [$value, self::from($value)->label()])
            ->all();
    }
}

<?php

namespace App\Enums;

enum Gender: int
{
    case MALE   = 1;
    case FEMALE = 2;
    case OTHER  = 3;


    /**
     * Return corresponding japanese name of each case.
     */
    public function label(): string
    {
        return match ($this) {
            self::MALE   => '男性',
            self::FEMALE => '女性',
            self::OTHER  => 'その他',
        };
    }

    /**
     * Return an associative array whose keys are values of cases and values are japanese labels.
     */
    public static function options(): array
    {
        // we cannot use mapWithKeys() because of auto-remapping of integer keys within blade directive @foreach
        $options = [];

        foreach (self::cases() as $case) {
            $options[$case->value] = $case->label();
        }

        return $options;
    }
}

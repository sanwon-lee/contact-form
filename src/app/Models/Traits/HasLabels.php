<?php

namespace App\Models\Traits;

use Illuminate\Support\Str;

trait HasLabels
{
    public static function getLabel(string $column): string
    {
        $modelName = Str::snake(class_basename(static::class));

        return __("models.{$modelName}.{$column}");
    }
}

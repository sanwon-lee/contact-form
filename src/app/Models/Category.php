<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public const COL_ID = 'id';
    public const COL_CONTENT = 'content';

    protected $fillable = [
        self::COL_CONTENT,
    ];
}

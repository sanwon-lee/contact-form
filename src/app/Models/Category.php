<?php

namespace App\Models;

use App\Models\Traits\HasLabels;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, HasLabels;

    public const COL_ID = 'id';
    public const COL_CONTENT = 'content';

    protected $fillable = [
        self::COL_CONTENT,
    ];
}

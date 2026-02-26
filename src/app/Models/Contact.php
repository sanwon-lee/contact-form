<?php

namespace App\Models;

use App\Models\Traits\HasLabels;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contact extends Model
{
    /** @use HasFactory<\Database\Factories\ContactFactory> */
    use HasFactory, HasLabels;

    public const COL_ID          = 'id';
    public const COL_CATEGORY_ID = 'category_id';
    public const COL_FIRST_NAME  = 'first_name';
    public const COL_LAST_NAME   = 'last_name';
    public const COL_GENDER      = 'gender';
    public const COL_EMAIL       = 'email';
    public const COL_TEL         = 'tel';
    public const COL_ADDRESS     = 'address';
    public const COL_BUILDING    = 'building';
    public const COL_DETAIL      = 'detail';
    public const COL_CREATED_AT  = 'created_at';
    public const COL_UPDATED_AT  = 'updated_at';

    public const GENDER_MALE   = 1;
    public const GENDER_FEMALE = 2;
    public const GENDER_OTHER  = 3;

    protected $fillable = [
        self::COL_CATEGORY_ID,
        self::COL_FIRST_NAME,
        self::COL_LAST_NAME,
        self::COL_GENDER,
        self::COL_EMAIL,
        self::COL_TEL,
        self::COL_ADDRESS,
        self::COL_BUILDING,
        self::COL_DETAIL,
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn () => "{$this->{self::COL_LAST_NAME}} {$this->{self::COL_FIRST_NAME}}",
        );
    }

    public function genderOptions(): array
    {
        return [
            self::GENDER_MALE => self::getLabel('gender_male'),
            self::GENDER_FEMALE => self::getLabel('gender_female'),
            self::GENDER_OTHER => self::getLabel('gender_other'),
        ];
    }

    protected function genderText(): Attribute
    {
        return Attribute::make(
            get: fn () => self::genderOptions()[$this->{self::COL_GENDER}],
        );
    }
}

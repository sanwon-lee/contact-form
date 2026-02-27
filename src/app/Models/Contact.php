<?php

namespace App\Models;

use App\Enums\Gender;
use App\Models\Traits\HasLabels;
use Illuminate\Database\Eloquent\Builder;
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
    public const COL_CREATED_AT  = parent::CREATED_AT;
    public const COL_UPDATED_AT  = parent::UPDATED_AT;

    public const MAX_FULL_NAME_LENGTH = 8;

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

    protected $casts = [
        self::COL_GENDER => Gender::class,
        // self::COL_CREATED_AT => 'datetime',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn() => "{$this->{self::COL_LAST_NAME}}　{$this->{self::COL_FIRST_NAME}}",
        );
    }

    public function scopeSearch(Builder $query, array $filters): Builder
    {
        return $query->with('category')
            // search by category
            ->when($filters[self::COL_CATEGORY_ID] ?? null, function ($q, $categoryId) {
                $q->where(self::COL_CATEGORY_ID, $categoryId);
            })
            // search by keyword within name or email
            ->when($filters['keyword'] ?? null, function ($q, $keyword) {
                $wildcard = "%{$keyword}%";
                $q->where(function ($inner) use ($wildcard) {
                    $inner->whereLike(self::COL_FIRST_NAME, $wildcard)
                        ->orWhereLike(self::COL_LAST_NAME, $wildcard)
                        ->orWhereLike(self::COL_EMAIL, $wildcard);
                });
            })
            // search by the exact date
            ->when($filters['at'] ?? null, function ($q, $at) {
                $q->whereDate(self::COL_CREATED_AT, $at);
            });
    }

    public static function csvHeader(): array
    {
        return collect([
            self::COL_CATEGORY_ID,
            self::COL_FIRST_NAME,
            self::COL_LAST_NAME,
            self::COL_GENDER,
            self::COL_EMAIL,
            self::COL_TEL,
            self::COL_ADDRESS,
            self::COL_BUILDING,
            self::COL_DETAIL,
            self::COL_CREATED_AT,
        ])->map(self::getLabel(...))->all();
    }

    public function toCsvRow(): array
    {
        return [
            $this->category->{Category::COL_CONTENT},
            $this->{self::COL_FIRST_NAME},
            $this->{self::COL_LAST_NAME},
            $this->{self::COL_GENDER}->label(),
            $this->{self::COL_EMAIL},
            $this->{self::COL_TEL},
            $this->{self::COL_ADDRESS},
            $this->{self::COL_BUILDING},
            $this->{self::COL_DETAIL},
            $this->{self::COL_CREATED_AT}->format('Y/m/d'),
        ];
    }
}

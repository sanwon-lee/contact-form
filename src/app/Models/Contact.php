<?php

namespace App\Models;

use App\Enums\Gender;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $category_id
 * @property string $first_name
 * @property string $last_name
 * @property Gender $gender
 * @property string $email
 * @property string $tel
 * @property string $address
 * @property string|null $building
 * @property string $detail
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Category $category
 * @property-read mixed $full_name
 * @method static \Database\Factories\ContactFactory factory($count = null, $state = [])
 * @method static Builder<static>|Contact newModelQuery()
 * @method static Builder<static>|Contact newQuery()
 * @method static Builder<static>|Contact query()
 * @method static Builder<static>|Contact search(array $filters)
 * @method static Builder<static>|Contact whereAddress($value)
 * @method static Builder<static>|Contact whereBuilding($value)
 * @method static Builder<static>|Contact whereCategoryId($value)
 * @method static Builder<static>|Contact whereCreatedAt($value)
 * @method static Builder<static>|Contact whereDetail($value)
 * @method static Builder<static>|Contact whereEmail($value)
 * @method static Builder<static>|Contact whereFirstName($value)
 * @method static Builder<static>|Contact whereGender($value)
 * @method static Builder<static>|Contact whereId($value)
 * @method static Builder<static>|Contact whereLastName($value)
 * @method static Builder<static>|Contact whereTel($value)
 * @method static Builder<static>|Contact whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Contact extends Model
{
    /** @use HasFactory<\Database\Factories\ContactFactory> */
    use HasFactory;

    public const MAX_FULL_NAME_LENGTH = 8;
    public const MAX_DETAIL_LENGTH    = 120;

    public const CSV_COLUMNS = [
        'category_id',
        'first_name',
        'last_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'detail',
        'created_at',
    ];

    protected $fillable = [
        'category_id',
        'first_name',
        'last_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'detail',
    ];

    protected $casts = [
        'gender' => Gender::class,
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn() => "{$this->last_name}　{$this->first_name}",
        );
    }

    #[Scope]
    protected function search(Builder $query, array $filters): void
    {
        $query->with('category')
            // search by keyword within name and email
            ->when($filters['keyword'] ?? null, function ($q, $keyword) {
                $wildcard = "%{$keyword}%";
                $q->where(function ($inner) use ($wildcard) {
                    $inner->whereLike('first_name', $wildcard)
                        ->orWhereLike('last_name', $wildcard)
                        ->orWhereLike('email', $wildcard);
                });
            })
            // search by gender
            ->when($filters['gender'] ?? null, function ($q, $gender) {
                $q->where('gender', $gender);
            })
            // search by category
            ->when($filters['category_id'] ?? null, function ($q, $categoryId) {
                $q->where('category_id', $categoryId);
            })
            // search by the exact date
            ->when($filters['created_at'] ?? null, function ($q, $createdAt) {
                $q->whereDate('created_at', $createdAt);
            });
    }

    public static function csvHeader(): array
    {
        return collect(self::CSV_COLUMNS)->map(fn($col) => __("validation.attributes." . $col))->all();
    }

    public function toCsvRow(): array
    {
        $format = fn($col) => match ($col) {
            'category_id' => $this->category->content,
            'gender'      => $this->gender->label(),
            'created_at'  => $this->created_at->format('Y/m/d'),
            default       => $this->{$col} ?? '',
        };

        return collect(self::CSV_COLUMNS)->map($format)->all();
    }
}

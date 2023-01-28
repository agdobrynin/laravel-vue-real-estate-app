<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Apartment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'beds', 'baths', 'area', 'city', 'code', 'street', 'street_nr', 'price',
    ];

    protected $sortable = [
        'price', 'created_at'
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(
            \App\Models\User::class,
            'by_user_id'
        );
    }

    public function images(): HasMany
    {
        return $this->hasMany(ApartmentImage::class);
    }

    public function offers(): HasMany
    {
        return $this->hasMany(Offer::class, 'apartment_id');
    }

    public function scopeSortByCreated(Builder $builder): Builder
    {
        return $builder->orderByDesc('created_at');
    }

    public function scopeWithoutSold(Builder $builder): Builder
    {
//        return $builder->doesntHave('offers')
//            ->orWhereHas(
//                'offers',
//                fn(Builder $builder) => $builder->whereNull('accepted_at')
//                    ->whereNull('rejected_at')
//            );
        return $builder->whereNull('sold_at');
    }

    public function scopeFilters(Builder $builder, array $filters): Builder
    {
        return $builder->when(
            $filters['priceMin'] ?? false,
            fn($query, $value) => $query->where('price', '>=', (int)$value)
        )
            ->when(
                $filters['priceMax'] ?? false,
                fn($query, $value) => $query->where('price', '<=', (int)$value)
            )
            ->when(
                $filters['areaMin'] ?? false,
                fn($query, $value) => $query->where('area', '>=', (int)$value)
            )
            ->when(
                $filters['areaMax'] ?? false,
                fn($query, $value) => $query->where('area', '<=', (int)$value)
            )
            ->when(
                $filters['beds'] ?? false,
                fn($query, $value) => $query->where('beds', (int)$value < 4 ? '=' : '>=', (int)$value)
            )
            ->when(
                $filters['baths'] ?? false,
                fn($query, $value) => $query->where('baths', (int)$value < 4 ? '=' : '>=', (int)$value)
            )
            ->when($filters['deleted'] ?? false,
                fn($query, $value) => $query->withTrashed()
            )
            ->when(
                $filters['by'] ?? false,
                fn($query, $value) => \in_array($value, $this->sortable)
                    ? $query->orderBy($value, ($filters['order'] ?? 'desc'))
                    : $query
            );
    }
}

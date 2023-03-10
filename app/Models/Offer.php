<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = ['amount', 'accepted_at', 'rejected_at'];

    public function apartment(): BelongsTo
    {
        return $this->belongsTo(Apartment::class, 'apartment_id');
    }

    public function offeredByUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'offer_by_user_id');
    }

    public function scopeOfferByUser(Builder $builder, User $user): Builder
    {
        return $builder->where('offer_by_user_id', $user->id);
    }

    public function scopeExclude(Builder $query, Offer $offer): Builder
    {
        return $query->where('id', '!=', $offer->id);
    }
}

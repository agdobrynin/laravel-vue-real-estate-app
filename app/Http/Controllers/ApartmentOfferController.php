<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\Offer;
use App\Models\User;
use App\Notifications\OfferMade;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ApartmentOfferController extends Controller
{
    public function store(Apartment $apartment, Request $request): RedirectResponse
    {
        $apartment->load(['owner']);
        $this->authorize('make-offer', $apartment);

        $offer = new Offer(
            $request->validate([
                'amount' => 'required|integer|min:1|max:2000000000'
            ])
        );

        $offer->offeredByUser()->associate($request->user());
        $apartment->offers()->save($offer);

        /** @var User $owner */
        $owner = $apartment->owner;
        $owner->notify(
            new OfferMade($offer)
        );

        return back()->with('success', 'Offer was made');
    }
}

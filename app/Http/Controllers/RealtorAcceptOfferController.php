<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RealtorAcceptOfferController extends Controller
{
    public function __invoke(Offer $offer, Request $request): RedirectResponse
    {
        $apartment = $offer->apartment;
        $this->authorize('update', $apartment);

        $offer->update(['accepted_at' => now()]);

        $apartment->sold_at = now();
        $apartment->save();

        $apartment
            ->offers()
            ->exclude($offer)
            ->update(['rejected_at' => now()]);

        $message = sprintf('Offer # %s was accepted, other offers was rejected', $offer->id);

        return back()->with('success', $message);
    }
}

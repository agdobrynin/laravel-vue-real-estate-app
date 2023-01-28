<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Response;
use Inertia\ResponseFactory;

class ApartmentController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Apartment::class);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response|ResponseFactory
    {
        $filters = $request->only(['priceMin', 'priceMax', 'beds', 'baths', 'areaMin', 'areaMax']);
        $query = Apartment::SortByCreated()
            ->filters($filters)
            ->withoutSold()
            ->paginate(8)
            ->withQueryString();

        return inertia('Apartment/Index', [
            'filters' => $filters,
            'list' => $query
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Apartment $apartment): Response|ResponseFactory
    {
        $apartment->load(['images']);
        $offerMade = Auth::user()
            ? $apartment->offers()->offerByUser(Auth::user())->first()
            : null;

        return inertia('Apartment/Show', [
            'apartment' => $apartment,
            'offerMade' => $offerMade
        ]);
    }
}

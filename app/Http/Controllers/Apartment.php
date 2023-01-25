<?php

namespace App\Http\Controllers;

use App\Models\Apartment as ApartmentModel;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class Apartment extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response|ResponseFactory
    {
        $filters = $request->only(['priceMin', 'priceMax', 'beds', 'baths', 'areaMin', 'areaMax']);
        $query = ApartmentModel::SortByCreated()
            ->filters($filters)
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
    public function show(ApartmentModel $apartment): Response|ResponseFactory
    {
        $apartment->load(['images']);

        return inertia('Apartment/Show', [
            'apartment' => $apartment
        ]);
    }
}

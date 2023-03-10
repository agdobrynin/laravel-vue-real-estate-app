<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Response;
use Inertia\ResponseFactory;

class RealtorApartmentController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Apartment::class);
    }

    public function index(Request $request): Response|ResponseFactory
    {
        $filters = [
            'deleted' => $request->boolean('deleted'),
            ...$request->only(['by', 'order'])
        ];

        if (empty($filters['by'])) {
            $filters = [...$filters, 'by' => 'price', 'order' => 'asc'];
        }

        $list = Auth::user()
            ->apartments()
            ->filters($filters)
            ->withCount('images')
            ->withCount('offers')
            ->paginate(6)
            ->withQueryString()
        ;

        return inertia(
            'Realtor/Index',
            [
                'list' => $list,
                'filters' => $filters,
            ]
        );
    }

    public function show(Apartment $apartment): Response|ResponseFactory
    {
        $this->authorize('update', $apartment);

        $apartment = $apartment->load('offers', 'offers.offeredByUser');

        return inertia('Realtor/Show', ['apartment' => $apartment]);
    }

    public function destroy(Apartment $apartment): RedirectResponse
    {
        $apartment->deleteOrFail();

        return redirect()
            ->back()
            ->with('success', 'Apartment was deleted');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response|ResponseFactory
    {
        return inertia('Realtor/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->user()->apartments()->create(
            $request->validate([
                'beds' => 'required|integer|min:0|max:20',
                'baths' => 'required|integer|min:0|max:20',
                'area' => 'required|integer|min:12|max:1000',
                'city' => 'required|string|min:5',
                'street' => 'required|string|min:5',
                'code' => 'required|string|min:1',
                'street_nr' => 'required|integer|min:1',
                'price' => 'required|integer|min:1',
            ])
        );

        return redirect()
            ->route('realtor.apartment.index')
            ->with('success', 'Apartment was created');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Apartment $apartment): Response|ResponseFactory
    {
        return inertia('Realtor/Edit', [
            'apartment' => $apartment
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Apartment $apartment): RedirectResponse
    {
        $apartment->update(
            $request->validate([
                'beds' => 'required|integer|min:0|max:20',
                'baths' => 'required|integer|min:0|max:20',
                'area' => 'required|integer|min:12|max:1000',
                'city' => 'required|string|min:5',
                'street' => 'required|string|min:5',
                'code' => 'required|string|min:1',
                'street_nr' => 'required|integer|min:1',
                'price' => 'required|integer|min:1',
            ])
        );

        return redirect()
            ->route('realtor.apartment.index')
            ->with('success', 'Apartment was updated');
    }

    public function restore(Apartment $apartment): RedirectResponse
    {
        $apartment->restore();

        return redirect()
            ->back()
            ->with('success', 'Apartment was restored');
    }
}

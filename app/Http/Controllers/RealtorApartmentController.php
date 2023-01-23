<?php

namespace App\Http\Controllers;

use App\Models\Apartment as ApartmentModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Response;
use Inertia\ResponseFactory;

class RealtorApartmentController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(ApartmentModel::class);
    }

    public function index(Request $request): Response|ResponseFactory
    {
        $filters = [
            'deleted' => $request->boolean('deleted'),
            ...$request->only(['by', 'order'])
        ];

        $list = Auth::user()->apartments()->sortByPriceCheapest()->filters($filters);

        return inertia(
            'Realtor/Index',
            [
                'list' => $list->get(),
                'filters' => $filters,
            ]
        );
    }

    public function destroy(ApartmentModel $apartment): RedirectResponse
    {
        $apartment->deleteOrFail();

        return redirect()
            ->route('realtor.apartment.index')
            ->with('success', 'Apartment was deleted');
    }
}

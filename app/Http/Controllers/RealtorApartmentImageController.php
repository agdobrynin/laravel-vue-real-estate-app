<?php

namespace App\Http\Controllers;

use App\Models\Apartment as ApartmentModel;
use App\Models\ApartmentImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Response;
use Inertia\ResponseFactory;

class RealtorApartmentImageController extends Controller
{
    public function create(ApartmentModel $apartment): Response|ResponseFactory
    {
        $apartment->load(['images']);

        return inertia('Realtor/Image/Create', ['apartment' => $apartment]);
    }

    public function store(ApartmentModel $apartment, Request $request): RedirectResponse
    {
        if ($request->file('images')) {
            $request->validate(
                [
                    'images.*' => 'required|mimes:jpg,png,jpeg|max:500'
                ],
                [
                    'images.*.mimes' => 'The file should be in one of the formats: jpg, png, jpeg',
                    'images.*.max' => 'Maximum available size less or equal :max kilobytes'
                ]
            );

            foreach ($request->file('images') as $image) {
                $path = $image->store('images', 'public');
                $apartmentImage = new ApartmentImage(['filename' => $path]);

                $apartment->images()->save($apartmentImage);
            }

            return redirect()->back()->with('success', 'Images was uploaded');
        }

        abort(404, 'Upload files not found');
    }

    public function destroy(int $apartment, ApartmentImage $image): RedirectResponse
    {
        Storage::disk('public')->delete($image->filename);
        $image->delete();

        return back()->with('success', 'Image was deleted');
    }
}

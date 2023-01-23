<?php

namespace App\Http\Controllers;

use Inertia\Response;
use Inertia\ResponseFactory;

class RealtorApartmentController extends Controller
{
    public function index(): Response|ResponseFactory
    {
        return inertia('Realtor/Index');
    }
}

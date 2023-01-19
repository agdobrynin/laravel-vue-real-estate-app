<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Response;
use Inertia\ResponseFactory;

class UserAccountController extends Controller
{
    public function create(): Response|ResponseFactory
    {
        return inertia('UserAccount/Create');
    }

    public function store(Request $request): RedirectResponse
    {
        $user = User::create($request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed'
        ]));

        Auth::login($user);

        return redirect()->route('apartment.index')
            ->with('success', 'User was create');
    }
}

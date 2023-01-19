<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function create(): \Inertia\Response|\Inertia\ResponseFactory
    {
        return inertia('Auth/Login');
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $isAuth = Auth::attempt($request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]), true);

        if (false === $isAuth) {
            throw ValidationException::withMessages([
                'email' => 'Authenticate failed'
            ]);
        }

        $request->session()->regenerate();

        return redirect()->intended();
    }

    public function destroy(Request $request): \Illuminate\Http\RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerate();

        return redirect()->route('apartment.index');
    }
}

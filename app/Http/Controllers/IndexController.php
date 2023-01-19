<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Inertia\Response;
use Inertia\ResponseFactory;

class IndexController extends Controller
{
    public function index(): Response|ResponseFactory
    {
        $name = 'Stranger';

        if ($user = Auth::user()) {
            $name = $user->name;
        }

        $message = sprintf('Hello %s 👋', $name);

        return inertia('Index/Index', compact('message'));
    }
}

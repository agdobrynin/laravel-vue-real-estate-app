<?php
declare(strict_types=1);

namespace App\Http\Controllers;

class IndexController extends Controller
{
    public function index(): \Inertia\Response|\Inertia\ResponseFactory
    {
        return inertia('Index/Index', ['message' => 'Hello 👋']);
    }
}

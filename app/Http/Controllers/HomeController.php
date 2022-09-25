<?php

namespace App\Http\Controllers;

use App\Models\ActivityType;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function home()
    {
        return Inertia::render('home')
            ->withViewData([
                "title" => "Home",
            ]);
    }

    public function info()
    {
        return Inertia::render('info')
            ->withViewData([
                "title" => "Intel",
                "description" => "Read all about it!",
            ]);
    }

    public function archive()
    {
        return Inertia::render('archive')
            ->withViewData([
                "title" => "Archive",
                "description" => "View previously released classified information.",
            ]);
    }

    public function links()
    {
        return Inertia::render('links')
            ->withViewData([
                "title" => "Spy Gadgets",
                "description" => "Get all the cool stuff like hookshots and lasers.",
            ]);
    }
}

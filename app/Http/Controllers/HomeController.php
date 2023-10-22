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
                "title" => "About",
                "description" => "Read all about it!",
            ]);
    }

    public function archive()
    {
        return Inertia::render('archive')
            ->withViewData([
                "title" => "Archive",
                "description" => "View previous champions and almost champions.",
            ]);
    }

    public function links()
    {
        return Inertia::render('links')
            ->withViewData([
                "title" => "Links",
                "description" => "Find all the links you need to get started.",
            ]);
    }

    public function irc()
    {
        return Inertia::render('irc')
            ->withViewData([
                "title" => "Race Chat",
                "description" => "This is where you join a race!",
            ]);
    }

    public function match()
    {
        return Inertia::render('match')
            ->withViewData([
                "title" => "Match",
                "description" => "Your current matchup.",
            ]);
    }
}

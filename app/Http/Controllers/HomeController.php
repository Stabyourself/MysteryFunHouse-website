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
                "description" => "Mystery Tournament is an event in which players will participate in a series of matches, racing against a single opponent per round in short to medium length goals.",
                "image" => asset("/img/home.jpg"),
            ]);
    }

    public function info()
    {
        return Inertia::render('info')
            ->withViewData([
                "title" => "Intel",
                "description" => "Read all about it!",
                "image" => asset("/img/home.jpg"),
            ]);
    }

    public function archive()
    {
        return Inertia::render('archive')
            ->withViewData([
                "title" => "Archive",
                "description" => "View previously released Classified Information",
                "image" => asset("/img/home.jpg"),
            ]);
    }
}

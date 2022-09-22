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
                "description" => "Mystery Fun Fest is a cooperative event in which two teams compete to accrue the most tickets throughout its 17-day duration.",
                "image" => asset("/img/home.jpg"),
            ]);
    }
}

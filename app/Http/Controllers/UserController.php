<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Impairment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class UserController extends Controller
{
    public function signUpForm()
    {
        $user = [];
        if (Auth::check()) {
            $user = Auth::user()->load("impairments:id")->only("challonge_username", "pronouns", "timezone", "availability", "impairments");
        }

        $impairments = Impairment::all("id", "name");

        return Inertia::render('User/SignUp', compact("impairments", "user"))
            ->withViewData([
                "title" => "Sign Up",
                "description" => "Sign up for Mystery Tournament 17",
            ]);
    }

    public function signUp(Request $request)
    {
        if (!Auth::check()) {
            abort(403);
        }

        $event = Event::latest()->first(); // questionable

        $validated = $request->validate([
            "challonge_username" => "required|string",
            "pronouns" => "nullable|string",
            "timezone" => "nullable|string",
            "availability" => "nullable|string",
            "impairments" => "array",
            "impairments.*" => "integer",
            "flavor" => "nullable|string",
        ]);

        $user = Auth::user();

        // update all them fields
        $user->challonge_username = $validated["challonge_username"];
        $user->pronouns = $validated["pronouns"] ?? "";
        $user->timezone = $validated["timezone"] ?? "";
        $user->availability = $validated["availability"] ?? "";

        // update impairments
        $user->impairments()->detach();
        foreach ($validated["impairments"] as $impairmentId) {
            $impairment = Impairment::find($impairmentId);

            $user->impairments()->attach($impairment);
        }

        // update signup (or create it)
        $wasSignedUp = $user->events->contains($event->id);

        $user->events()->detach($event->id);
        $user->events()->attach($event->id, [
            "flavor" => $validated["flavor"] ?? "",
        ]);


        if ($wasSignedUp) {
            session()->flash('flash', [
                'type' => 'success',
                'text' => "Your profile has been updated.",
            ]);
        } else {
            session()->flash('flash', [
                'type' => 'success',
                'text' => "Successfully signed up!",
            ]);
        }

        $user->save();


        return redirect()->route("home");
    }

    public function show(User $user)
    {
    }
}

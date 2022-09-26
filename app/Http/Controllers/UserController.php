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
            $user = Auth::user()->load("impairments:id")->only("challonge_username", "twitch", "pronouns", "timezone", "availability", "impairments");
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
            "twitch" => "required|string",
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
        $user->twitch = $validated["twitch"];
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


        return redirect()->route("signedUp");
    }

    public function signedUp()
    {
        return Inertia::render('User/SignedUp')
            ->withViewData([
                "title" => "Sign Up",
                "description" => "Sign up for Mystery Tournament 17",
            ]);
    }

    public function index()
    {
        $users = User::with("events")->get(["id", "username", "avatar"]);


        $users = $users->filter(function ($user) {
            return $user->events->count() > 0; // this won't work in the future
        });

        $users = $users->toArray();

        foreach ($users as &$user) {
            $user["flavor"] = $user["events"][0]["pivot"]["flavor"];
            unset($user["events"]);
        }

        return Inertia::render('players', compact("users"))
            ->withViewData([
                "title" => "Agents",
                "description" => "View the database of known agents.",
            ]);
    }
}

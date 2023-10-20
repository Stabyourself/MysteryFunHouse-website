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
        $user = new User();
        if (Auth::check()) {
            $user = Auth::user()->load("impairments:id")->only("challonge_username", "twitch", "pronouns", "timezone", "availability", "impairments", "flavor", "flag", "srl_username");
        }

        $impairments = Impairment::all("id", "name");

        return Inertia::render('User/SignUp', compact("impairments", "user"))
            ->withViewData([
                "title" => "Sign Up",
                "description" => "Sign up for Mystery Tournament 18",
            ]);
    }

    public function signUp(Request $request)
    {
        if (!Auth::check()) {
            abort(403);
        }

        $event = Event::find(2); // questionable

        $validated = $request->validate([
            "challonge_username" => "required|string",
            "twitch" => "required|string",
            "pronouns" => "nullable|string",
            "timezone" => "nullable|string",
            "availability" => "nullable|string",
            "impairments" => "array",
            "impairments.*" => "integer",
            "flavor" => "nullable|string",
            "flag" => "string",
            "srl_username" => "string",
        ]);

        $user = Auth::user();

        // update all them fields
        $user->challonge_username = $validated["challonge_username"];
        $user->twitch = $validated["twitch"];
        $user->pronouns = $validated["pronouns"] ?? "";
        $user->timezone = $validated["timezone"] ?? "";
        $user->availability = $validated["availability"] ?? "";
        $user->flag = $validated["flag"];
        $user->srl_username = $validated["srl_username"];

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


        // if ($wasSignedUp) {
        //     session()->flash('flash', [
        //         'type' => 'success',
        //         'text' => "Your profile has been updated.",
        //     ]);
        // } else {
        //     session()->flash('flash', [
        //         'type' => 'success',
        //         'text' => "Successfully signed up!",
        //     ]);
        // }

        $user->save();


        return redirect()->route("signedUp");
    }

    public function signedUp()
    {
        return Inertia::render('User/SignedUp')
            ->withViewData([
                "title" => "Sign Up",
                "description" => "Sign up for Mystery Tournament 18",
            ]);
    }

    public function index()
    {
        $users = User::with("events")->orderBy("username")->get(["id", "username", "avatar"]);


        $users = $users->filter(function ($user) {
            // where user is signed up for event
            return $user->events->where("id", 2)->count() > 0;
        });

        foreach ($users as &$user) {
            $event = $user->events->where("id", 2)->first();
            $user->flavor = $event->pivot->flavor;
        }

        $users = $users->toArray();

        return Inertia::render('players', compact("users"))
            ->withViewData([
                "title" => "Players",
                "description" => "View all the players signed up for Mystery Tournament 18",
            ]);
    }
}

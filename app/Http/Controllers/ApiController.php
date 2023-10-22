<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    public function user(Request $request, $challongeName)
    {
        $user = User::where("challonge_username", $challongeName)->first()->only("id", "twitch", "pronouns");
        return response()->json($user);
    }

    public function opponent(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(["error" => "no_login"], 401);
        }

        $opponent = $user->opponent();

        if (gettype($opponent) === "string") {
            return response()->json(["error" => $opponent], 400);
        }

        $flavor = $opponent->pivot->flavor;
        $opponent = $opponent->only("id", "username", "avatar", "flag", "timezone", "availability");
        $opponent["flavor"] = $flavor;

        return response()->json($opponent);
    }
}

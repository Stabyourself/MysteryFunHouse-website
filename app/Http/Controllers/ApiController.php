<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function user(Request $request, $challongeName)
    {
        $user = User::where("challonge_username", $challongeName)->first()->only("id", "twitch", "pronouns");
        return response()->json($user);
    }
}

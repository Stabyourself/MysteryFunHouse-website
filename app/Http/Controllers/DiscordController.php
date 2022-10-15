<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use \GuzzleHttp;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DiscordController extends Controller
{
  protected $tokenURL = "https://discord.com/api/oauth2/token";
  protected $apiURLBase = "https://discord.com/api/users/@me";
  protected $apiURLBaseGuild = "https://discord.com/api/users/@me/guilds/83038855732658176/member";
  protected $tokenData = [
    "client_id" => NULL,
    "client_secret" => NULL,
    "grant_type" => "authorization_code",
    "code" => NULL,
    "redirect_uri" => NULL,
    "scope" => "identifiy&email&guilds.members.read"
  ];

  public function tologin()
  {
    if (Auth::check()) {
      return redirect()->route("home");
    };

    if (!session()->has('from')) {
      session(['from' => url()->previous()]);
    }

    return redirect("https://discord.com/oauth2/authorize?client_id=" . config("discord.client_id") . "&redirect_uri=" . config("discord.redirect_uri") . "&response_type=code&scope=identify%20email%20guilds.members.read");
  }

  public function loginCallback(Request $request)
  {
    if (Auth::check()) {
      return redirect()->route("home");
    };
    if ($request->missing("code") && $request->missing("access_token")) {
      return redirect()->route("home");
    };

    $this->tokenData["client_id"] = config("discord.client_id");
    $this->tokenData["client_secret"] = config("discord.client_secret");
    $this->tokenData["redirect_uri"] = config("discord.redirect_uri");
    $this->tokenData["code"] = $request->get("code");

    $client = new GuzzleHttp\Client();

    try {
      $accessTokenData = $client->post($this->tokenURL, ["form_params" => $this->tokenData]);
      $accessTokenData = json_decode($accessTokenData->getBody());
    } catch (\GuzzleHttp\Exception\ClientException $error) {
      Log::error("Couldn't authenticate: " . $error->getMessage());
      abort(500);
    };

    // get general user data
    $userData = Http::withToken($accessTokenData->access_token)->get($this->apiURLBase);
    if ($userData->clientError() || $userData->serverError()) {
      Log::error("Couldn't fetch Discord data: " . $userData->body());
      abort(500);
    };
    $userData = json_decode($userData);

    // get MFH specific user data
    $guildData = Http::withToken($accessTokenData->access_token)->get($this->apiURLBaseGuild);
    if ($guildData->clientError() || $guildData->serverError()) {
      return "We couldn't fetch your data. Are you in the MFH Discord server?";
    };
    $guildData = json_decode($guildData);

    // get the most relevant avatar
    $avatar = "default";
    $avatarType = null;

    if (!empty($userData->avatar)) {
      $avatar = $userData->avatar;
      $avatarType = "user";
    }

    if (!empty($guildData->avatar)) {
      $avatar = $guildData->avatar;
      $avatarType = "guild";
    }

    // see if we need to cache that avatar
    $user = User::find($userData->id);

    if ((empty($user) || $avatar != $user->avatar) && $avatar != "default") {
      // No avatar or outdated avatar
      if ($avatarType == "user") {
        $avatarUrl = "https://cdn.discordapp.com/avatars/$userData->id/$avatar";
      } elseif ($avatarType == "guild") {
        $avatarUrl = "https://cdn.discordapp.com/guilds/83038855732658176/users/$userData->id/avatars/$avatar";
      }

      $folder = Storage::path('public/avatars/');
      // create the folder if it doesn't exist
      if (!file_exists($folder)) {
        mkdir($folder, 0777, true);
      }

      $path = Storage::path('public/avatars/' . $avatar);
      try {
        $client->request('GET', $avatarUrl, [
          'sink' => $path,
        ]);
      } catch (\GuzzleHttp\Exception\ClientException $error) {
        // if the request fails for whatever reason, avatar is default
        $avatar = "default";
      };
    }

    // get the most relevant username
    $username = $userData->username; // this is always set

    if (!empty($guildData->nick)) {
      $username = $guildData->nick;
    }

    // this isn't great but I dunno lmao
    $challongeUsername = "";
    $twitch = "";
    $pronouns = "";
    $timezone = "";
    $availability = "";

    if ($user) {
      $challongeUsername = $user->challonge_username;
      $twitch = $user->twitch;
      $pronouns = $user->pronouns;
      $timezone = $user->timezone;
      $availability = $user->availability;
    }

    $user = User::updateOrCreate(
      [
        'id' => $userData->id,
      ],
      [
        'id' => $userData->id,
        'username' => $username,
        'discriminator' => $userData->discriminator,
        'email' => $userData->email,
        'avatar' => $avatar,
        'verified' => $userData->verified,
        'locale' => $userData->locale,
        'mfa_enabled' => $userData->mfa_enabled,
        'refresh_token' => $accessTokenData->refresh_token,

        'slug' => Str::slug($userData->username . "-" . $userData->discriminator),
        'challonge_username' => $challongeUsername,
        'twitch' => $twitch,
        'pronouns' => $pronouns,
        'timezone' => $timezone,
        'availability' => $availability,
      ]
    );

    Auth::login($user, true);

    return redirect(session('from'));
  }

  public function logout(Request $request)
  {
    Auth::logout();
    $request->session()->invalidate();

    return redirect()->back();
  }
}

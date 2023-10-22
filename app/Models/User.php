<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use App\Services\ChallongeService;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'username',
        'discriminator',
        'email',
        'avatar',
        'verified',
        'locale',
        'mfa_enabled',
        'refresh_token',

        "slug",
        "challonge_username",
        "twitch",
        "pronouns",
        "timezone",
        "availability",
        "flag",
        "srl_username"
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var boolean
     */
    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'refresh_token',
        'remember_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    public function events()
    {
        return $this->belongsToMany(Event::class, "signups")->withTimestamps()->withPivot("flavor", "challonge_id");
    }

    public function impairments()
    {
        return $this->belongsToMany(Impairment::class)->withTimestamps();
    }

    public function opponent()
    {
        // TODO: $event = Event::latest()->first();
        $event = Event::first();

        $challongeService = resolve(ChallongeService::class);

        $challongeId = $this->getChallongeId($event);

        if (!$challongeId) {
            return "no_challonge_id";
        }

        $matches = collect($challongeService->getParticipantMatches($event->challonge_id, $challongeId));

        // TODO: open
        $match = $matches->where("match.state", "complete")->last();

        if (!$match) {
            return "no_match";
        }

        $opponentId = $match["match"]["player1_id"] == $challongeId ? $match["match"]["player2_id"] : $match["match"]["player1_id"];

        $opponent = $this->getByChallongeId($event, $opponentId);

        if (!$opponent) {
            return "no_opponent";
        }

        return $opponent;
    }

    public function getChallongeId($event)
    {
        $signup = $this->events->find($event->id);

        if (!$signup) {
            return null;
        }

        if (!$signup->pivot->challonge_id) {
            $this->setChallongeId($signup);
        }

        return $signup->pivot->challonge_id;
    }

    public function setChallongeId($signup)
    {
        $challongeService = resolve(ChallongeService::class);

        $challongeId = $signup->challonge_id;

        $participantId = $challongeService->getParticipantId($challongeId, $this->challonge_username);


        $signup->pivot->challonge_id = $participantId;
        $signup->pivot->save();
    }

    static public function getByChallongeId($event, $challongeId)
    {
        if (!$event) {
            return null;
        }

        $signup = $event->users()->wherePivot("challonge_id", $challongeId)->first();

        if (!$signup) {
            $challongeService = resolve(ChallongeService::class);

            $challongeName = $challongeService->getParticipantName($event->challonge_id, $challongeId);

            $signup = $event->users->filter(function ($user) use ($challongeName) {
                return strtolower($user->challonge_username) == strtolower($challongeName);
            })->first();

            if ($signup) {
                $signup->pivot->challonge_id = $challongeId;
                $signup->pivot->save();
            }
        }

        return $signup;
    }
}

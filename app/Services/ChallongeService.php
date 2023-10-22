<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ChallongeService
{
  private $url;
  private $apiKey;

  public function __construct()
  {
    $this->url = config("challonge.url");
    $this->apiKey = config("challonge.apiKey");
  }

  public function getParticipantId($tournamentId, $challongeName)
  {
    $response = Http::get(
      "{$this->url}/tournaments/$tournamentId/participants.json",
      [
        "api_key" => $this->apiKey
      ]
    );

    $participants = $response->json();
    foreach ($participants as $participant) {
      if ($participant["participant"]["name"] == $challongeName) {
        return $participant["participant"]["id"];
      }
    }

    return null;
  }

  public function getParticipantName($tournamentId, $challongeId)
  {
    $response = Http::get(
      "{$this->url}/tournaments/$tournamentId/participants.json",
      [
        "api_key" => $this->apiKey
      ]
    );

    $participants = $response->json();
    foreach ($participants as $participant) {
      if ($participant["participant"]["id"] == $challongeId) {
        return $participant["participant"]["name"];
      }
    }

    return null;
  }

  public function getParticipantMatches($tournamentId, $challongeId)
  {
    $response = Http::get(
      "{$this->url}/tournaments/$tournamentId/matches.json",
      [
        "api_key" => $this->apiKey,
        "participant_id" => $challongeId
      ]
    );

    return $response->json();
  }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NHLGameResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "game_id" => $this->game_id,
            "winner" => $this->winner,
            "scheduled" => $this->scheduled,
            "home_score" => $this->home_score,
            "away_score" => $this->away_score,
            "home_shots" => $this->home_shots,
            "away_shots" => $this->away_shots,
            "home_team_id" => $this->home_team_id,
            "away_team_id" => $this->away_team_id,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "home_team_name" => $this->home_team->city . ' ' . $this->home_team->name, //TODO: this could be on the model
            "away_team_name" => $this->away_team->city . ' '. $this->away_team->name,
        ];
    }
}

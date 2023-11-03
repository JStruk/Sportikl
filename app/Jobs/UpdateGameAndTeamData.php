<?php

namespace App\Jobs;

use App\Models\Game;
use App\Models\Team;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class UpdateGameAndTeamData implements ShouldQueue
{
    protected Game $game;

    public function __construct(Game $game)
    {
        $this->game = $game;
    }

    public function handle(): void
    {
        $gameId = $this->game->game_id;

        // Fetch the boxscore data from the NHL Stats API
        $response = Http::get("https://statsapi.web.nhl.com/api/v1/game/{$gameId}/boxscore");

        if ($response->failed()) {
            Log::error("Failed to fetch boxscore data for Game ID: {$gameId}");
            return;
        }

        $boxscoreData = $response->json();

        if (isset($boxscoreData['teams'])) {
            $homeTeam = $boxscoreData['teams']['home'];
            $awayTeam = $boxscoreData['teams']['away'];

            // Update the Game model with scores and shots
            $this->game->update([
                'home_score' => $homeTeam['teamStats']['teamSkaterStats']['goals'],
                'away_score' => $awayTeam['teamStats']['teamSkaterStats']['goals'],
                'home_shots' => $homeTeam['teamStats']['teamSkaterStats']['shots'],
                'away_shots' => $awayTeam['teamStats']['teamSkaterStats']['shots'],
            ]);

            // Update the Team models' wins, losses, and ties
            $homeTeamModel = Team::query()->find($this->game->home_team_id);
            $awayTeamModel = Team::query()->find($this->game->away_team_id);

            if ($homeTeam['teamStats']['teamSkaterStats']['goals'] > $awayTeam['teamStats']['teamSkaterStats']['goals']) {
                // Home team wins
                $homeTeamModel->increment('wins');
                $awayTeamModel->increment('losses');
            } elseif ($homeTeam['teamStats']['teamSkaterStats']['goals'] < $awayTeam['teamStats']['teamSkaterStats']['goals']) {
                // Away team wins
                $homeTeamModel->increment('losses');
                $awayTeamModel->increment('wins');
            } else {
                // It's a tie
                $homeTeamModel->increment('ties');
                $awayTeamModel->increment('ties');
            }
        }
    }
}

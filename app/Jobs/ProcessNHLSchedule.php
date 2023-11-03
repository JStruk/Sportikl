<?php

namespace App\Jobs;

use App\Models\Game;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ProcessNHLSchedule implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Fetch the JSON payload from the NHL Stats API (Replace 'your_api_key' with your actual API key)
        $response = Http::get('https://statsapi.web.nhl.com/api/v1/schedule', [
            'date' => '2023-10-24', // Replace with the desired date
        ]);

        if ($response->failed()) {
            Log::error('Failed to fetch NHL schedule data');
            return;
        }

        $scheduleData = $response->json();

        if (isset($scheduleData['dates'][0]['games'])) {
            foreach ($scheduleData['dates'][0]['games'] as $gameData) {
                $gameId = $gameData['gamePk'];
                $homeTeamId = $gameData['teams']['home']['team']['id'];
                $awayTeamId = $gameData['teams']['away']['team']['id'];
                $scheduled = $gameData['gameDate'];

                // Save the game data to the database
                // can we do this as a batch instead?
                Game::query()->create([
                    'game_id' => $gameId,
                    'scheduled' => Carbon::parse($scheduled),
                    'home_team_id' => $homeTeamId,
                    'away_team_id' => $awayTeamId,
                ]);
            }
        }
    }
}

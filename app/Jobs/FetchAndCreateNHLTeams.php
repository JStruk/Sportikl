<?php

namespace App\Jobs;

use App\Models\Team;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FetchAndCreateNHLTeams implements ShouldQueue
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
        // Fetch NHL team information from the NHL Stats API
        $response = Http::get('https://statsapi.web.nhl.com/api/v1/teams');

        if ($response->failed()) {
            Log::error('Failed to fetch NHL team data');
            return;
        }

        $teamData = $response->json();

        if (isset($teamData['teams'])) {
            foreach ($teamData['teams'] as $teamInfo) {
                $teamId = $teamInfo['id'];
                $city = $teamInfo['locationName'];
                $teamName = $teamInfo['teamName'];
                $arenaName = $teamInfo['venue']['name'];

                // Create a new Team model for each team
                Team::query()->create([
                    'id' => $teamId,
                    'city' => $city,
                    'name' => $teamName,
                    'arena_name' => $arenaName,
                ]);
            }
        }
    }
}

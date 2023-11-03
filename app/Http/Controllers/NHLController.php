<?php

namespace App\Http\Controllers;

use App\Http\Resources\NHLGameResource;
use App\Models\Game;
use Illuminate\Http\Request;
use Inertia\Inertia;

class NHLController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        //TODO: paginate this based on date?
        $games = Game::all();

        return Inertia::render('NHL', [
            'games' => NHLGameResource::collection($games)
        ]);
    }
}

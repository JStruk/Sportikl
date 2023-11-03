<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Game extends Model
{
    use HasFactory;

    protected $primaryKey = 'game_id';
    protected $keyType = 'string';
    protected $fillable = [
        'game_id',
        'home_team_id',
        'away_team_id',
        'scheduled',
        'winner',
        'home_score',
        'away_score',
        'home_shots',
        'away_shots',
    ];

    public function home_team(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'home_team_id');
    }

    public function away_team(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'away_team_id');
    }
}

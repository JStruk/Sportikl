<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'city',
        'name',
        'arena_name',
        'logo_path',
        'wins',
        'losses',
        'overtime_losses'
    ];
}

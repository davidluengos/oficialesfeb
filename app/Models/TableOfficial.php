<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TableOfficial extends Model
{
    use HasFactory;

    protected $fillable = [
        'city_id',
        'name',
        'surname',
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function scorerGames()
    {
        return $this->hasMany(Game::class, 'scorer_id');
    }

    public function timerGames()
    {
        return $this->hasMany(Game::class, 'timer_id');
    }

    public function shotClockOperatorGames()
    {
        return $this->hasMany(Game::class, 'shot_clock_operator_id');
    }

    public function assistantScorerGames()
    {
        return $this->hasMany(Game::class, 'assistant_scorer_id');
    }

}

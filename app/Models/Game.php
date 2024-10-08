<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'time',
        'category_id',
        'local_team_id',
        'scorer_id',
        'timer_id',
        'shot_clock_operator_id',
        'assistant_scorer_id',
        'scorer_travels',
        'timer_travels',
        'shot_clock_operator_travels',
        'assistant_scorer_travels'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function localTeam()
    {
        return $this->belongsTo(Team::class, 'local_team_id');
    }

    public function scorer()
    {
        return $this->belongsTo(TableOfficial::class, 'scorer_id');
    }

    public function timer()
    {
        return $this->belongsTo(TableOfficial::class, 'timer_id');
    }

    public function shotClockOperator()
    {
        return $this->belongsTo(TableOfficial::class, 'shot_clock_operator_id');
    }

    public function assistantScorer()
    {
        return $this->belongsTo(TableOfficial::class, 'assistant_scorer_id');
    }
}

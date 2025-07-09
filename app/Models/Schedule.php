<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'sport_id', 'gender', 'team_a_id', 'team_b_id', 'match_date', 'match_time', 'venue', 'stage'
    ];

    public function sport() { return $this->belongsTo(Sport::class); }
    public function teamA() { return $this->belongsTo(Team::class, 'team_a_id'); }
    public function teamB() { return $this->belongsTo(Team::class, 'team_b_id'); }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Scoreboard extends Model
{
    use HasFactory; 
    protected $fillable = ['team_id', 'sport_id', 'gold', 'silver', 'bronze', 'total']; 
    public function team() { 
        return $this->belongsTo(Team::class); 
    } 
    
    public function sport() { 
        return $this->belongsTo(Sport::class); 
    }
}

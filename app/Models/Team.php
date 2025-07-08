<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Team extends Model
{
    use HasFactory; 

    protected $table = 'teams';

    protected $fillable = ['name', 'description', 'photo'];
    // protected $fillable = ['name']; 
    public function scoreboards() { 
        return $this->hasMany(Scoreboard::class);
        // return $this->hasMany(Scoreboard::class); 
        // return $this->hasOne(\App\Models\Scoreboard::class, 'id');
        // return $this->hasOne(\App\Models\Scoreboard::class, 'team_id');
    }
}

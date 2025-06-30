<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Team extends Model
{
    use HasFactory; 
    protected $fillable = ['name']; 
    public function scoreboards() { 
        return $this->hasMany(Scoreboard::class); 
    }
}

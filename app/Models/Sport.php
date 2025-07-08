<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{

    use HasFactory;

    protected $table = 'sports';

    protected $fillable = ['sport_name', 'gender', 'photo', 'description'];

    public function scoreboards()
    {
        return $this->hasMany(Scoreboard::class);
    }

    // protected $fillable = [
    //     'sport_name',
    //     'description',
    // ];
}

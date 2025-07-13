<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rules extends Model
{
    use HasFactory;

    protected $table = 'rules';

    protected $primaryKey = 'RuleID'; // Set the primary key to RuleID

    protected $fillable = [
        'sport_id',
        'title',
        'description',
        'profile_picture',
        'file_path',
    ];

    // Relationship to Sport
    public function sport()
    {
        return $this->belongsTo(\App\Models\Sport::class, 'sport_id');
    }
}

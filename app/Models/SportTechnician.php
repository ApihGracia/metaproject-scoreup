<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Model;

// class SportTechnician extends Model
class SportTechnician extends Authenticatable
{
    use Notifiable;

    protected $guard = 'technician';

    protected $fillable = [
        'name',
        'email',
        'sport_id',
        'phone_number',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function sport()
    {
        return $this->belongsTo(Sport::class);
    }
}

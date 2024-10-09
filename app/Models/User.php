<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'username',
        'phone_number',
    ];

    public function userLink(): HasOne
    {
        return $this->hasOne(UserLink::class);
    }

    public function luckyResults(): HasMany
    {
        return $this->hasMany(Game::class);
    }
}

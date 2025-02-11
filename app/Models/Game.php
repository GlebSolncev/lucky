<?php

namespace App\Models;

use App\Enums\TypeResult;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'number',
        'type',
        'points',
    ];

    protected $casts = [
        'type' => TypeResult::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

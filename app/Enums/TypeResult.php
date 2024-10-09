<?php

namespace App\Enums;

enum TypeResult: int
{
    case LOSE = 0;

    case WIN = 1;

    public function label()
    {
        return match ($this) {
            self::LOSE => 'Lose',
            self::WIN => 'Win',
        };
    }
}

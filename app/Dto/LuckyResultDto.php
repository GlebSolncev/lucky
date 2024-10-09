<?php

namespace App\Dto;

use App\Enums\TypeResult;

class LuckyResultDto
{
    public int $randomNumber;

    public string $type;

    public float $points;

    public function __construct(int $randomNumber, TypeResult $type, float $points)
    {
        $this->randomNumber = $randomNumber;
        $this->type = $type->label();
        $this->points = $points;
    }
}

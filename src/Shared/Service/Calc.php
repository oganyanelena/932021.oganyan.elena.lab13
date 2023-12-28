<?php

declare(strict_types=1);

namespace App\Shared\Service;

use App\Shared\Exception\DivisionByZeroException;

class Calc
{
    public static function add(int $firstValue, int $secondValue): int
    {
        return $firstValue + $secondValue;
    }

    public static function sub(int $firstValue, int $secondValue): int
    {
        return $firstValue - $secondValue;
    }

    public static function mult(int $firstValue, int $secondValue): int
    {
        return $firstValue * $secondValue;
    }

    public static function div(int $firstValue, int $secondValue): int
    {
        try {
            return (int)($firstValue / $secondValue);
        } catch (\DivisionByZeroError $error) {
            throw new DivisionByZeroException(message:"Attempt to divide $firstValue by zero", previous: $error);
        }
    }
}

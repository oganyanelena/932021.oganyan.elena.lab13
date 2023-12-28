<?php

declare(strict_types=1);

namespace App\Quiz\Question;

use App\Quiz\Question\DTO\QuizQuestionDTO;
use App\Shared\Service\Calc;

class QuizQuestionService
{
    public static function getQuestionDTO(): QuizQuestionDTO
    {
        $operations = QuestionOperationEnum::cases();
        $operation = $operations[array_rand($operations)];
        $firstValue = random_int(1, 100);
        $secondValue = random_int(1, 100);
        $result = self::getResult($firstValue, $secondValue, $operation);

        return new QuizQuestionDTO($firstValue, $secondValue, $operation->value, $result);
    }

    private static function getResult(int $firstValue, int $secondValue, QuestionOperationEnum $operation): int
    {
        return match ($operation) {
            QuestionOperationEnum::addition => Calc::add($firstValue, $secondValue),
            QuestionOperationEnum::subtraction => Calc::sub($firstValue, $secondValue)
        };
    }
}

<?php

declare(strict_types=1);

namespace App\Quiz\Question\DTO;

readonly class QuizQuestionDTO
{
    public function __construct(
        public int $firstValue,
        public int $secondValue,
        public string $operationSymbol,
        public int $answer
    ) {
    }
}

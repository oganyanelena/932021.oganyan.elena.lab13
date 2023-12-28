<?php

declare(strict_types=1);

namespace App\Quiz\Result;

readonly class QuizResultDTO
{
    public int $firstValue;
    public int $secondValue;
    public string $operation;
    public ?int $userAnswer;
    public bool $isCorrect;

    public function __construct(array $resultData)
    {
        [
            'firstValue' => $this->firstValue,
            'secondValue' => $this->secondValue,
            'operationSymbol' => $this->operation,
            'userAnswer' => $this->userAnswer,
            'isCorrect' => $this->isCorrect,
        ] = $resultData;
    }
}

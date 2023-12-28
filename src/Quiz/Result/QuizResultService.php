<?php

declare(strict_types=1);

namespace App\Quiz\Result;

use App\Quiz\Question\DTO\QuizAnswerDTO;
use App\Quiz\Question\DTO\QuizQuestionDTO;

class QuizResultService
{
    public static function getQuizResultDTO(QuizQuestionDTO $questionDTO, QuizAnswerDTO $answerDTO): QuizResultDTO
    {
        $resultData = [
          'firstValue' => $questionDTO->firstValue,
          'secondValue' => $questionDTO->secondValue,
          'operationSymbol' => $questionDTO->operationSymbol,
          'userAnswer' => $answerDTO->answer,
          'isCorrect' => $questionDTO->answer === $answerDTO->answer
        ];

        return new QuizResultDTO($resultData);
    }
}

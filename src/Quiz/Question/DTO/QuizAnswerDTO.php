<?php

declare(strict_types=1);

namespace App\Quiz\Question\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class QuizAnswerDTO
{
    #[Assert\NotBlank(message: 'Please enter your answer', allowNull: false)]
    public ?int $answer;
}

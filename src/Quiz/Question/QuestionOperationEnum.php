<?php

declare(strict_types=1);

namespace App\Quiz\Question;

enum QuestionOperationEnum: string
{
    case addition = '+';
    case subtraction = '-';
}

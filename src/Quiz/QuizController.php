<?php

declare(strict_types=1);

namespace App\Quiz;

use App\Quiz\Question\DTO\QuizAnswerDTO;
use App\Quiz\Question\DTO\QuizQuestionDTO;
use App\Quiz\Question\QuizForm;
use App\Quiz\Question\QuizQuestionService;
use App\Quiz\Result\QuizResultService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route(path: '/Quiz', name: 'quiz_')]
class QuizController extends AbstractController
{
    #[Route(name: 'show')]
    public function index(Request $request, SerializerInterface $serializer): Response
    {
        $form = $this->createForm(QuizForm::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash('quiz-answer', $serializer->serialize($form->getData(), 'json'));
            if ($form->get('finish')->isClicked()) {
                return $this->redirectToRoute('quiz_result');
            }
        } else { // reload page of question
            $quizQuestionFlashes = $request->getSession()->getFlashBag()->peek('quiz-question');
            if (count($quizQuestionFlashes) > 1) {
                $nullAnswer = new QuizAnswerDTO();
                $nullAnswer->answer = null;
                $this->addFlash('quiz-answer', $serializer->serialize($nullAnswer, 'json'));
            } else {
                $request->getSession()->getFlashBag()->get('quiz-question');
            }
        }

        $questionDTO = QuizQuestionService::getQuestionDTO();
        $this->addFlash('quiz-question', $serializer->serialize($questionDTO, 'json'));

        return $this->render('@src_dir/Quiz/Question/output.twig', [
            'form' => $form->createView(),
            'question' => $questionDTO,
        ]);
    }

    #[Route(path: '/result', name: 'result')]
    public function result(Request $request, SerializerInterface $serializer, QuizResultService $resultService): Response
    {
        $resultDTOs = [];
        $questions = $request->getSession()->getFlashBag()->get('quiz-question');
        $answers = $request->getSession()->getFlashBag()->get('quiz-answer');

        if (count($answers) < count($questions)) { // leaved last question
            array_splice($questions, -1);
        } elseif (count($answers) > count($questions)) { // returned to previous page
            array_splice($answers, 0, 1);
        }

        foreach ($answers as $key => $answer) {
            $question = $serializer->deserialize($questions[$key], QuizQuestionDTO::class, 'json');
            $answer = $serializer->deserialize($answer, QuizAnswerDTO::class, 'json');

            $resultDTOs[] = $resultService::getQuizResultDTO($question, $answer);
        }

        return $this->render('@src_dir/Quiz/Result/output.twig', [
            'resultDTOs' => $resultDTOs
        ]);
    }
}

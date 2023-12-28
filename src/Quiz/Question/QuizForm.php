<?php

declare(strict_types=1);

namespace App\Quiz\Question;

use App\Quiz\Question\DTO\QuizAnswerDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuizForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('answer', IntegerType::class)
            ->add('finish', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => QuizAnswerDTO::class,
        ]);
    }

    public function getBlockPrefix(): string
    {
        return '';
    }
}

<?php

namespace App\Form;

use App\Entity\Major;
use App\Entity\Student;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StudentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('student_name')
            ->add('student_description', TextareaType::class)
            ->add('student_summary', TextareaType::class)
            ->add('student_gender',ChoiceType::class, [
                'placeholder' => 'Choose an option',
                'choices' => [
                    'Male' => '1',
                    'Female' => '0',
                ],
            ])
            ->add('student_status',ChoiceType::class, [
                'placeholder' => 'Choose an option',
                'choices' => [
                    'Active' => '1',
                    'Deactive' => '0',
                ],
            ])
            ->add('major', EntityType::class, [
                'class' => Major::class,
                'multiple' => false,
                'choice_label' => 'major_name',
                'expanded' => false
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Student::class,
            // 'allow_extra_fields' => true // <<<<<<<<<<<<<<<<<<<<<
        ]);
    }
}

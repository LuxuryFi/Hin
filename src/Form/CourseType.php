<?php

namespace App\Form;

use App\Entity\Course;
use App\Entity\Subject;
use App\Entity\Teacher;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CourseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('course_name')
            ->add('course_description')
            ->add('subject', EntityType::class, [
                'class' => Subject::class,
                'multiple' => false,
                'choice_label' => 'subject_name',
                'expanded' => false
            ])
            ->add('teacher', EntityType::class, [
                'class' => Teacher::class,
                'multiple' => false,
                'choice_label' => 'teacher_name',
                'expanded' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Course::class,
        ]);
    }
}

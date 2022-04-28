<?php

namespace App\Form;

use App\Entity\Enrollment;
use App\Entity\Course;
use App\Entity\Student;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EnrollmentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('course', EntityType::class, [
                'class' => Course::class,
                'multiple' => false,
                'choice_label' => 'course_name',
                'expanded' => false
            ])
            ->add('student', EntityType::class, [
                'class' => Student::class,
                'multiple' => false,
                'choice_label' => 'student_name',
                'expanded' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Enrollment::class,
        ]);
    }
}

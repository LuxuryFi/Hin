<?php

namespace App\Form;

use App\Entity\Major;
use App\Entity\Teacher;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TeacherType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('teacher_name')
            ->add('teacher_description', TextareaType::class)
            ->add('teacher_summary', TextareaType::class)
            ->add('teacher_gender',ChoiceType::class, [
                'placeholder' => 'Choose an option',
                'choices' => [
                    'Male' => '1',
                    'Female' => '0',
                ],
            ])
            ->add('teacher_status',ChoiceType::class, [
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
            'data_class' => Teacher::class,
            // 'allow_extra_fields' => true // <<<<<<<<<<<<<<<<<<<<<
        ]);
    }
}

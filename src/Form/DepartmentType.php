<?php

namespace App\Form;

use App\Entity\Department;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class DepartmentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('deptName', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Name of the department'
            ])
            ->add('description',TextareaType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('address', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('roiUrl', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'ROI url of the department',
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Department::class,
        ]);
    }
}

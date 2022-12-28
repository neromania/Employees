<?php

namespace App\Form;

use App\Entity\Employee;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class EmployeeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('birthDate', DateType::class,[
                'attr' => [ 'class' => 'form-control'],
                'widget' => 'single_text',
                'label' => 'Birth date :',
                'attr' => ['class' => 'js-datepicker'],
            ])
            ->add('firstName', TextType::class, [
                'attr' => [ 'class' => 'form-control'],
                'label' => 'Firstname :',
                ])
            ->add('lastName', TextType::class, [
                'attr' => [ 'class' => 'form-control'],
                'label' => 'Lastname :',
            ])
            ->add('gender', ChoiceType::class, [
                'label' => 'Gender :',
                'attr' => [ 'class' => 'form-control'],
                'choices'  => [
                    'Male' => 'M',
                    'Female' => 'F',
                    'Other' => 'X',
                ],
            ])
            ->add('email', EmailType::class, [
                'attr' => [ 'class' => 'form-control'],
            ])
            ->add('photo', TextType::class,[
                'attr' => [ 'class' => 'form-control'],
            ])
            ->add('hireDate', DateType::class,[
                'attr' => [ 'class' => 'form-control'],
                'widget' => 'single_text',
                'label' => 'hire date',
                'attr' => ['class' => 'js-datepicker'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Employee::class,
        ]);
    }
}

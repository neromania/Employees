<?php

namespace App\Form;

//use App\Entity\Demand;
use App\Controller\OfferController;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
//use Symfony\Component\OptionsResolver\OptionsResolver;

class OfferType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Firstname', TextType::class,[
                'attr' => array(
                    'class' => 'form-control'
                )
            ])
            ->add('Lastname', TextType::class,[
                'attr' => array(
                    'class' => 'form-control'
                )
            ])
            ->add('birth_date',DateType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'attr' => array(
                    'class' => 'form-control'
                )
            ])
            ->add('pdfFile', FileType::class, [
                'label' => 'Upload your CV',
                'mapped' => false,
                'required' => false,
                'attr' => array(
                    'class' => 'form-control'
                )
                /*'constraints' => [
                    new File([
                        'maxSize' => '5M',
                        'mimeTypes' => [
                            'application/pdf',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid PDF document',
                    ])
                ],*/
            ])
            ->add('Which_department_and_title', TextType::class,[
                'attr' => array(
                    'class' => 'form-control'
                )
            ])
            ->add('Submit', SubmitType::class, [
                'attr' => array(
                    'class' => 'btn btn-primary'
                )
            ])
        ;
    }

    /*public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Offer::class,
        ]);
    }*/
}
<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\PaymentMethod;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => "Nom :",
            ])
            ->add('firstname', TextType::class, [
                'label' => "Prénom :",
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email :',
            ])
            ->add('address', TextType::class, [
                'label' => 'Adresse :',
            ])
            ->add('additionalAddress', TextType::class, [
                'label' => 'Adresse complémentaire :',
                'required' => false
            ])
            ->add('streetNumber', IntegerType::class, [
                'label' => "Numéro de rue :",
            ])
            ->add('zipCode', TextType::class, [
                'label' => "Code Postal :",
            ])
            ->add('city', TextType::class, [
                'label' => "Ville :",
            ])
            ->add('country', TextType::class, [
                'label' => "Pays :",
            ])
            ->add('paymentMethods', EntityType::class,[
                'class' => PaymentMethod::class,
                'choice_label' => "type",
                'label' => "Moyen(s) de paiement :",
                'multiple' => true,
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
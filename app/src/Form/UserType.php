<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\PaymentMethod;
use App\Entity\Supplier;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => "Prénom :",
            ])
            ->add('name', TextType::class, [
                'label' => "Nom :",
            ])
            ->add('email',  EmailType::class, [
                'label' => 'Email :',
            ])
            ->add('address',  TextType::class, [
                'label' => 'Adresse :',
            ])
            ->add('additionalAddress',  TextType::class, [
                'label' => 'Adresse complémentairte :',
                'required' => false,
            ])
            ->add('streetNumber', IntegerType::class, [
                'label' => 'Numéro de rue :',
            ])
            ->add('zipCode',  TextType::class, [
                'label' => 'Code postal :',
            ])
            ->add('country',  TextType::class, [
                'label' => 'Pays :',
            ])
            ->add('restriction',  CheckboxType::class, [
                'label' => 'Restriction ?',
                'required' => false,
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
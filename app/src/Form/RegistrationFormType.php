<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;


class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom :',
            ])
            ->add('prenom', TextType::class, [
                'label' => 'Prénom :',
            ])
            ->add('adresse', TextType::class, [
                'label' => 'Adresse :',
            ])
            ->add('adresse_complementaire', TextType::class,[
                'label' => 'Adresse Complémentaire :',
                'required' => false
            ])
            ->add('ville', TextType::class, [
                'label' => 'Ville :',
            ])
            ->add('code_postal', TextType::class, [
                'label' => 'Code Postal :',
            ])
            ->add('numero_rue', IntegerType::class, [
                'label' => 'Numéro de rue :',
            ])
            ->add('pays', TextType::class, [
                'label' => 'Pays'
            ])
            ->add('email')
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'label' => 'Convenir des conditions d\'utilisation',
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'label' => 'Mot de passe',
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
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

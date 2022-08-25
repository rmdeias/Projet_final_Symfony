<?php

namespace App\Form;

use App\Entity\PaymentMethod;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Validator\Constraints\Regex;


class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom :',
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Prénom :',
            ])
            ->add('address', TextType::class, [
                'label' => 'Adresse :',
            ])
            ->add('additionalAddress', TextType::class,[
                'label' => 'Adresse Complémentaire :',
                'required' => false
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville :',
            ])
            ->add('zipCode', TextType::class, [
                'label' => 'Code Postal :',
                'constraints' => [
                    new Regex([
                        'pattern' => "`^\d{2,}$`",
                        'message' => "Le code postal ne correspond pas au format."
                    ])
                ],
            ])
            ->add('streetNumber', IntegerType::class, [
                'label' => 'Numéro de rue :',
            ])
            ->add('country', CountryType::class, [
                'label' => 'Pays :',
                'preferred_choices' => array('FR')
            ])
            ->add('email', EmailType::class, [
                'label' => "Email :",
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'label' => 'Convenir des conditions d\'utilisation',
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter nos conditions.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                'mapped' => false,
                'label' => 'Mot de passe',
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner un mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit être constitué d\'au moins {{ limit }} caractères',
                        'max' => 4096,
                    ]),
                    new Regex([
                        'pattern' => "/[A-Z]/",
                        'message' => 'Le mot de passe doit contenir au moins une majuscule',
                    ]),
                    new Regex([
                        'pattern' => "/[a-z]/",
                        'message' => 'Le mot de passe doit contenir au moins une minuscule',
                    ]),
                    new Regex([
                        'pattern' => "/\d/",
                        'message' => 'Le mot de passe doit contenir au moins un chiffre',
                    ]),
                    new Regex([
                        'pattern' => "/[$&+,:;=?@#|'<>.^*()%!-]/",
                        'message' => "Le mot de passe doit contenir au moins un caractère spécial"
                    ])
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

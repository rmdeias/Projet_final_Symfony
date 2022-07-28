<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\CustomerOrder;
use DateTime;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class CartType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('articles', EntityType::class,[
                'class' => Article::class,
                'choice_label' => "libelle",
                'label' => "Mes articles :",
                'multiple' => true,
                'required' => true
            ])
            ->add('date', DateType::class, [
                'label' => "Date :",
                'disabled' => true,
            ])
            ->add('statut', ChoiceType::class, [
                'label' => "Statut :",
                'choices' => [
                    'Dans mon panier' => CustomerOrder::STATUS_CART,
                    'En attente' => CustomerOrder::STATUS_PENDING,
                    'En cours de livraision' => CustomerOrder::STATUS_IN_DELIVERY,
                    'Livrée' => CustomerOrder::STATUS_LIVERY
                ],
                'disabled' => true
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CustomerOrder::class,
        ]);
    }
}
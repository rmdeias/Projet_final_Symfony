<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Categorie;
use App\Entity\Category;
use Doctrine\DBAL\Types\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle', TextType::class, [
                'label' => "Titre de l'article :",
            ])
            ->add('price', IntegerType::class, [
                'label' => "Prix :",
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description :',
            ])
            ->add('img', FileType::class, [
                'label' => 'Image principal :',
                'required' => false,
            ])
            ->add('img_alt', FileType::class, [
                'label' => 'Image annexe :',
                'required' => false
            ])
            ->add('promo', IntegerType::class, [
                'label' => "Promo :",
                'required' => false,
            ])
            ->add('category', EntityType::class,[
                'class' => Category::class,
                'choice_label' => "libelle",
                'label' => "Catégories :",
                'multiple' => true,
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class UpdateArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle', TextType::class, [
                'label' => "Titre de l'article :",
            ])
            ->add('prix', IntegerType::class, [
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
            ->add('when_deleted', DateType::class, [
                'label' => "Supprimé ?",
                'required' => false,
            ])
            ->add('categorie', EntityType::class,[
                'class' => Categorie::class,
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

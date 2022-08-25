<?php

namespace App\Form;

use App\Entity\Image;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('imageFile', VichImageType::class, [
                'label' => false,
                'allow_delete' => false,
                'required' => false,
                'download_uri' => true,
                'download_label' => true,
                'asset_helper' => true,
                'constraints' => [
                    new File([ 
                    'maxSize' => '1024k',
                      'mimeTypes' => [ // We want to let upload only txt, csv or Excel files
                        'image/jpg',
                        'image/jpeg',
                        'image/png' 
                      ],
                      'mimeTypesMessage' => "Le document est invalide.",
                    ])
                  ],
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Image::class,
        ]);
    }
}

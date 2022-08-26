<?php

namespace App\Controller\Admin;

use App\Entity\ArticleVariation;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ArticleVariationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ArticleVariation::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}

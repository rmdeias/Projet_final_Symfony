<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;

class ArticleCrudController extends AbstractCrudController
{
 
    public const PRODUCT_BASE_PATH = 'uploads/products';
    public const PRODUCT_UPLOAD_DIR = 'public/uploads/products';

    public static function getEntityFqcn(): string
    {
        return Article::class;
    }


    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('libelle'),
            MoneyField::new('price')->setCurrency('EUR'),
            TextAreaField::new('description')->hideOnIndex(),
            /*ImageField::new('img')
                ->setBasePath(self::PRODUCT_BASE_PATH)
                ->setUploadDir(self::PRODUCT_UPLOAD_DIR)
                ->setSortable(false)    
            ,
            ImageField::new('img_alt')
                ->setBasePath(self::PRODUCT_BASE_PATH)
                ->setUploadDir(self::PRODUCT_UPLOAD_DIR)
                ->setSortable(false)
                ->hideOnIndex()
            ,
            */
            IntegerField::new('promo'),
            DateField::new('when_deleted')->hideOnForm(),
            AssociationField::new('category')
        ];
    }
    
}

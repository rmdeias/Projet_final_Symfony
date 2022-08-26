<?php

namespace App\Controller\Admin;

use App\Entity\PaymentMethod;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PaymentMethodCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PaymentMethod::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('type'),
        ];
    }
    
}

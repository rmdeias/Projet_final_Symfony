<?php

namespace App\DataFixtures;

use App\Entity\Supplier;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SupplierFixtures extends Fixture implements DependentFixtureInterface
{
    public const SUPPLIER_REFERENCE = 'supplier ';

    public function load(ObjectManager $manager)
    {
        for ($count = 0; $count < 5; $count++) {
            $supplier = new Supplier();
            $supplier->setLibelle("supplier" . $count);
            $supplier->setAddress("address" .$count);
            $supplier -> setPhone('06006'.$count);

            $this->addReference(self::SUPPLIER_REFERENCE . $count, $supplier);
            $supplier->addArticleVariation($this->getReference("variation".$count));
            $manager->persist($supplier);
        }
        $manager->flush();
    }
    public function getDependencies(): array
    {
        return [
            ArticleVariationFixtures::class,
        ];
    }
}
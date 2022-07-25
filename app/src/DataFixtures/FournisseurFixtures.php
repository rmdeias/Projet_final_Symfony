<?php

namespace App\DataFixtures;

use App\Entity\Fournisseur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class FournisseurFixtures extends Fixture implements DependentFixtureInterface
{
    public const FOURNISSEUR_REFERENCE = 'fournisseur ';

    public function load(ObjectManager $manager)
    {
        for ($count = 0; $count < 5; $count++) {
            $fournisseur = new Fournisseur();
            $fournisseur->setLibelle("fournisseur" . $count);
            $fournisseur->setAddress("address" .$count);
            $fournisseur -> setPhone('06006'.$count);

            $this->addReference(self::FOURNISSEUR_REFERENCE . $count, $fournisseur);
            $fournisseur->addVariationArticle($this->getReference("variation".$count));
            $manager->persist($fournisseur);
        }
        $manager->flush();
    }
    public function getDependencies(): array
    {
        return [
            VariationArticleFixtures::class,
        ];
    }
}
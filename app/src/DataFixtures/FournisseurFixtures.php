<?php

namespace App\DataFixtures;

use App\Entity\Fournisseur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FournisseurFixtures extends Fixture
{
    public const FOURNISSEUR_REFERENCE = 'fournisseur ';

    public function load(ObjectManager $manager)
    {
        for ($count = 0; $count < 5; $count++) {
            $fournisseur = new Fournisseur();
            $fournisseur->setLibelle("fournisseur" . $count);
            $this->addReference(self::FOURNISSEUR_REFERENCE . $count, $fournisseur);
            $fournisseur->addArticle($this->getReference('Article ' .$count));
            $manager->persist($fournisseur);
        }
        $manager->flush();
    }
}
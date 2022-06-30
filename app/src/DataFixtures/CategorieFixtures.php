<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategorieFixtures extends Fixture
{
    public const CATEGORIE_REFERENCE = 'categorie ';

    public function load(ObjectManager $manager)
    {
        for ($count = 0; $count < 5; $count++) {
            $categorie = new Categorie();
            $categorie->setLibelle("Categorie " . $count);
            $this->addReference(self::CATEGORIE_REFERENCE . $count, $categorie);
            $categorie->addArticle($this->getReference('Article ' .$count));

            $manager->persist($categorie);
        }
        $manager->flush();
    }
}
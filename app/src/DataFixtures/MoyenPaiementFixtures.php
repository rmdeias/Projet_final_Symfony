<?php

namespace App\DataFixtures;

use App\Entity\MoyenPaiement;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class MoyenPaiementFixtures extends Fixture implements DependentFixtureInterface
{

    public const PAIEMENT_REFERENCE = 'moyenPaiement';
    public function load(ObjectManager $manager)
    {
        for ($count = 0; $count < 3; $count++) {
            $moyenPaiement = new MoyenPaiement();
            $moyenPaiement->setType("moyenPaiement" . $count);
            $this->addReference(self::PAIEMENT_REFERENCE . $count, $moyenPaiement);
            $moyenPaiement->addUser($this->getReference('mail'.$count.'@gmail.com'));
            $manager->persist($moyenPaiement);

        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
        ];
    }
}
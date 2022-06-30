<?php

namespace App\DataFixtures;

use App\Entity\Commande;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;


class CommandeFixtures extends Fixture implements DependentFixtureInterface
{
public const COMMANDE_REFERENCE ='commande';
    public function load(ObjectManager $manager)
    {
        $date = new \DateTime('@'.strtotime('now'));
        for ($count = 0; $count < 3; $count++) {
            $commande = new Commande();
            $commande->setStatut("status".$count);
            $commande->setUser($this->getReference("mail".$count."@gmail.com"));
            $commande->setDate($date);
            //$this->addReference(self::COMMANDE_REFERENCE. $count, $commande);
            $manager->persist($commande);
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
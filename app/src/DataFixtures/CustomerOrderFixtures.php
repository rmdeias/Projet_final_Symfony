<?php

namespace App\DataFixtures;

use App\Entity\CustomerOrder;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;


class CustomerOrderFixtures extends Fixture implements DependentFixtureInterface
{
public const ORDER_REFERENCE ='order';
    public function load(ObjectManager $manager)
    {
        $date = new \DateTime('@'.strtotime('now'));
        for ($count = 0; $count < 5; $count++) {
            $order = new CustomerOrder();
            $order->setStatut("status".$count);
            $order->setUser($this->getReference("mail".$count."@gmail.com"));
            $order->setDate($date);
            $this->addReference(self::ORDER_REFERENCE. $count, $order);
            $manager->persist($order);
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
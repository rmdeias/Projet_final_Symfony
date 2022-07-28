<?php

namespace App\DataFixtures;

use App\Entity\PaymentMethod;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PaymentMethodFixtures extends Fixture
{

    public const PAYMENT_REFERENCE = 'paymentMethod';
    public function load(ObjectManager $manager)
    {
        for ($count = 0; $count < 5; $count++) {
            $paymentMethod = new PaymentMethod();
            $paymentMethod->setType("paymentMethod" . $count);
            $this->addReference(self::PAYMENT_REFERENCE . $count, $paymentMethod);
            $paymentMethod->addUser($this->getReference('mail'.$count.'@gmail.com'));
            $manager->persist($paymentMethod);

        }
        $manager->flush();
    }

}
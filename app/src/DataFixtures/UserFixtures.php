<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private $passwordHasher;


    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager)
    {
        for ($count = 0; $count < 5; $count++) {
            $user = new User();
            $password = "password".$count;
            $hashedPassword = $this->passwordHasher->hashPassword(
                $user,
                $password
            );
            $user->setName("userNom" . $count);
            $user->setFirstName("userPrenom" . $count);
            $user->setEmail("mail".$count."@gmail.com");
            $user->setPassword( $hashedPassword);
            $user->setRestriction(false);
            $user->setAddress("Adresse" . $count);
            $user->setStreetNumber(11);
            $user->setZipCode("88888");
            $user->setCity('ville '. $count);
            $user->setCountry("pays" . $count);
            $this->addReference("mail".$count."@gmail.com", $user);

            $manager->persist($user);
        }
        $manager->flush();
    }

}


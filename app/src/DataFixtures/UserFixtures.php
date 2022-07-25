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
        for ($count = 0; $count < 3; $count++) {
            $user = new User();
            $password = "password".$count;
            $hashedPassword = $this->passwordHasher->hashPassword(
                $user,
                $password
            );
            $user->setNom("userNom" . $count);
            $user->setPrenom("userPrenom" . $count);
            $user->setEmail("mail".$count."@gmail.com");
            $user->setPassword( $hashedPassword);
            $user->setRestriction(false);
            $user->setAdresse("Adresse" . $count);
            $user->setNumeroRue(11);
            $user->setCodePostal("88888");
            $user->setVille('ville '. $count);
            $user->setPays("pays" . $count);
            $this->addReference("mail".$count."@gmail.com", $user);

            $manager->persist($user);
        }
        $manager->flush();
    }

}


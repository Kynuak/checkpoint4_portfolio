<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

;

class UserFixtures extends Fixture
{

    public function __construct(private UserPasswordHasherInterface $passordHasher){}

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail("admin@trouille.fr");
        $user->setRoles(["ROLE_ADMIN"]);
        $hashedPassword = $this->passordHasher->hashPassword(
            $user,
            "adminadmin"
        );
        $user->setPassword($hashedPassword);
        $user->setPresentation("Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
        Nunc vitae quam quis quam volutpat tincidunt. 
        Cras accumsan mi sit amet sapien fringilla feugiat. Ut fringilla commodo turpis nec dignissim. 
        Cras et pretium quam, quis lobortis ex. Nullam bibendum, 
        massa id facilisis ultrices, ante tortor laoreet nunc, ultrices cursus odio turpis.");
        $manager->persist($user);


        $manager->flush();
    }
}

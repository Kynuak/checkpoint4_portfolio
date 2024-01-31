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
        $user->setPresentation(
            "Ancien technicien de maintenance passionné par l'informatique et le développement web, je me suis récemment reconverti pour me consacrer pleinement à ma passion : le code.

            Cette reconversion m'a permis de découvrir plus précisément le monde fascinant du développement. Aujourd'hui, je suis déterminé à créer des applications innovantes et à contribuer au progrès technologique.");
        $manager->persist($user);


        $manager->flush();
    }
}

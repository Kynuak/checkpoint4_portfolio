<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\HardSkill;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
;

class HardSkillFixtures extends Fixture implements DependentFixtureInterface
{

    private const HARDSKILLS = [
        [
            "name" => "PHP",
            "image" =>  "icone-php.svg",
            "category_ref" => "category_Backend"
        ],
        [
            "name" => "Twig",
            "image" => "icone-twig.svg",
            "category_ref" => "category_Frontend"
        ],
        [
            "name" => "Javascript",
            "image" => "icone-javascript.svg",
            "category_ref" => "category_Frontend"
        ],
        [
            "name" => "Photoshop",
            "image" => "icone-photoshop.svg",
            "category_ref" => "category_Conception"
        ],
        [
            "name" => "Git",
            "image" => "icone-github.svg",
            "category_ref" => "category_Gestion de projet"
        ]
    ];


    public function load(ObjectManager $manager): void
    {

        foreach(self::HARDSKILLS as $hardSkill) {
            $hardSkillEntity = new HardSkill();
            $hardSkillEntity->setName($hardSkill['name']);
            $hardSkillEntity->setImage($hardSkill['image']);
            $hardSkillEntity->setCategory($this->getReference($hardSkill['category_ref']));
            $manager->persist($hardSkillEntity);
            $this->addReference("hardskill_". $hardSkill['name'], $hardSkillEntity);
        }




        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class
        ];
    }
}

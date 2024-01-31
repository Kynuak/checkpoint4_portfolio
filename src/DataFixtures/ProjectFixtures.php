<?php

namespace App\DataFixtures;

use App\Entity\Project;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
;

class ProjectFixtures extends Fixture implements DependentFixtureInterface
{   
    private const PROJECTS = [
        [
            "name" => "Bobo-Coffee",
            "description" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
            Nunc vel augue a ipsum aliquet sodales id sed enim. Nam vel eros nec est faucibus 
            tempus quis id lorem. Praesent vulputate.",
            "url_github" => "https://github.com/Kynuak/mon_portfolio",
            "image" => "bobo-coffee.png",
            "hardSkill" => [
                "PHP",
                "Twig",
                "Git"
            ]
        ],
        [
            "name" => "Straszik",
            "description" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
            Nunc vel augue a ipsum aliquet sodales id sed enim. Nam vel eros nec est faucibus 
            tempus quis id lorem. Praesent vulputate.",
            "url_github" => "https://github.com/Kynuak/mon_portfolio",
            "image" => "straszik.png",
            "hardSkill" => [
                "PHP",
                "Twig",
                "Git"
            ]
        ],
        [
            "name" => "Wildy Gaming",
            "description" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
            Nunc vel augue a ipsum aliquet sodales id sed enim. Nam vel eros nec est faucibus 
            tempus quis id lorem. Praesent vulputate.",
            "url_github" => "https://github.com/Kynuak/mon_portfolio",
            "image" => "Wildy Gaming.png",
            "hardSkill" => [
                "PHP",
                "Twig",
                "Git"
            ]
        ],
    ];


    public function load(ObjectManager $manager): void
    {

        foreach(self::PROJECTS as $project) {
            $projectEntity = new Project();
            $projectEntity->setName($project['name']);
            $projectEntity->setDescription($project['description']);
            $projectEntity->setImage($project['image']);
            $projectEntity->setUrlGithub($project['url_github']);
            foreach($project['hardSkill'] as $hardSkillName) {
                $projectEntity->addHarkSill($this->getReference("hardskill_".$hardSkillName));
            }
            $manager->persist($projectEntity);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            HardSkillFixtures::class
        ];
    }
}

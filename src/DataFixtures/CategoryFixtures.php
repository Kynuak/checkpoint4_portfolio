<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
;

class CategoryFixtures extends Fixture
{
    private const CATEGORIES = [
        "Frontend",
        "Backend",
        "Conception",
        "Gestion de projet"
    ];


    public function load(ObjectManager $manager): void
    {

        foreach(self::CATEGORIES as $categoryName) {
            $category = new Category();
            $category->setName($categoryName);
            $manager->persist($category);
            $this->addReference("category_" . $categoryName, $category);
        }

        $manager->flush();
    }
}

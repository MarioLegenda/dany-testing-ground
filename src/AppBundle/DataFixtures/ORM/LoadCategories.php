<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Category;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class LoadCategories implements FixtureInterface
{
    public function load(ObjectManager $em)
    {
        $faker = Factory::create();

        for ($i = 0; $i < 50; $i++) {
            $category = new Category();
            $category->setName($faker->word);

            $em->persist($category);
        }

        $em->flush();
    }
}
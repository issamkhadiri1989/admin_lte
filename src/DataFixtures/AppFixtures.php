<?php

namespace App\DataFixtures;

use App\Factory\AuthorFactory;
use App\Factory\BookFactory;
use App\Factory\CategoryFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $categories = CategoryFactory::createMany(10);

        $authors = AuthorFactory::createMany(5);

       /* $books = BookFactory::createMany(500, [
            'author' => AuthorFactory::random(),
            'categories' => CategoryFactory::randomRange(1, 4),
        ]);*/

        $manager->flush();
    }
}

<?php

namespace App\DataFixtures;

use App\Factory\AuthorFactory;
use App\Factory\BookFactory;
use App\Factory\CategoryFactory;
use App\Factory\PlanFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    private const AUTHORS = 30;

    private const CATEGORIES = 5;

    private const BOOKS = 300;

    public function load(ObjectManager $manager): void
    {
        AuthorFactory::createMany(self::AUTHORS);
        CategoryFactory::createMany(self::CATEGORIES);
        BookFactory::createMany(self::BOOKS);

        $manager->flush();
    }
}

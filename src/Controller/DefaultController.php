<?php

declare(strict_types=1);

namespace App\Controller;

use App\Factory\AuthorFactory;
use App\Factory\BookFactory;
use App\Factory\CategoryFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route(path: "/", name: "app_default")]
    public function index(): Response
    {
        $categories = CategoryFactory::createMany(10);

        $authors = AuthorFactory::createMany(5);

        $books = BookFactory::createMany(500, [
            'author' => AuthorFactory::random(),
            'categories' => CategoryFactory::randomRange(1, 4),
        ]);

        return $this->render('default/index.html.twig');
    }
}
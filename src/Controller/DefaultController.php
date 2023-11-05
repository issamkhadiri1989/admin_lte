<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Book;
use App\Factory\AuthorFactory;
use App\Factory\BookFactory;
use App\Factory\CategoryFactory;
use App\Order\OrderCheckout;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route(path: "/", name: "app_default")]
    public function index(EntityManagerInterface $manager, Request $request, OrderCheckout $checkout): Response
    {
        $page = $request->query->get('page', 1);
        $repository = $manager->getRepository(Book::class);

        $checkout->checkout();

        $books = $repository->getBooksWithTitle('CUMQUE', $page);

        return $this->render(
            'default/index.html.twig',
            [
                'booksList' => $books,
            ]
        );
    }
}
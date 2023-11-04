<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Book;
use App\Factory\AuthorFactory;
use App\Factory\BookFactory;
use App\Factory\CategoryFactory;
use App\Order\OrderCheckout;
use App\Service\Notification\MailNotifier;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{

    public function __construct(
        private OrderCheckout $orderCheckout
    ) {
    }

    #[Route(path: "/", name: "app_default")]
    public function index(EntityManagerInterface $manager, Request $request): Response
    {
        $repository = $manager->getRepository(Book::class);
        $page = $request->query->get('page', 1);

        $books = $repository->findBy(
            criteria: [],
            orderBy: ['id' => 'asc'],
            limit: 10,
            offset: ($page - 1) * 10
        );
//        $books = $repository->findByIsbn('9790488437566');

        $book = $repository->findOneBy(['isbn' => '9790488437566']);

//        $this->mail->sendMail();
            $this->orderCheckout->checkout();

        return $this->render(
            'default/index.html.twig',
            [
                'booksList' => $books,
            ]
        );
    }
}
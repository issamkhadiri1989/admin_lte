<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/books', name: 'app_book_')]
class BookController extends AbstractController
{
    #[Route('/', name: 'list')]
    #[Route('/category/{id}', name: 'list_by_category')]
    public function index(BookRepository $repository, ?Category $category = null): Response
    {
        $booksList = null === $category ? $repository->findAll() : $repository->findBy(['category' => $category]);

        return $this->render('book/index.html.twig', [
            'books' => $booksList,
            'category' => $category,
        ]);
    }
}

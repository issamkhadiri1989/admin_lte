<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\Category;
use App\Form\Type\BookType;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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

    #[Route("/new", name: "new")]
    #[Route("/edit/{id}", name: "edit")]
    public function manageBook(Request $request, EntityManagerInterface $manager, ?Book $book): Response
    {
        $routeName = $request->attributes->get('_route');
        if ('app_book_edit' === $routeName && null === $book) {
            throw new NotFoundHttpException('Resource not found');
        }

        $book ??= new Book();
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ('app_book_new' === $routeName) {
                // do something with the $book object like persisting it in the database
                $manager->persist($book);
                $message = 'The book has been successfully added !';
            } else {
                $message = 'The book has been successfully edited !';
            }
            $manager->flush();

            $this->addFlash('success', $message);

            return $this->redirectToRoute('app_book_edit', ['id' => $book->getId()]);
        }

        return $this->render('book/manage.html.twig', [
            'form' => $form,
            'is_editing' => 'app_book_edit' === $routeName
        ]);
    }
}

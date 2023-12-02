<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\Type\BookType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    #[Route('/book', name: 'app_book')]
    public function index(): Response
    {
        return $this->render('book/index.html.twig', [
            'controller_name' => 'BookController',
        ]);
    }

    #[Route('/book/add', name: 'app_add_book')]
    public function add(Request $request, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(BookType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //
            $book = $form->getData();

            $manager->persist($book);
            $manager->flush();

            return $this->redirectToRoute(
                'app_edit_book',
                [
                    'id' => $book->getId(),
                ]
            );
        }

        return $this->render('book/add.html.twig', [
            'controller_name' => 'BookController',
            'bookForm' => $form,
        ]);
    }


    #[Route('/book/edit/{id}', name: 'app_edit_book')]
    public function edit(
        Request $request,
        EntityManagerInterface $manager,
        Book $book
    ): Response {
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->flush();
        }

        return $this->render('book/add.html.twig', [
            'controller_name' => 'BookController',
            'bookForm' => $form,
        ]);
    }
}

<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\Type\SearchBookType;
use App\Repository\BookRepository;
use App\ValueObject\Search;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    #[Route('/search', name: 'app_search')]
    public function index(): Response
    {
        $form = $this->createForm(
            type: SearchBookType::class,
            options: ['action' => $this->generateUrl('app_result')]
        );

        return $this->render('search/index.html.twig', [
            'my_form' => $form,
        ]);
    }

    #[Route('/result', name: 'app_result')]
    public function result(Request $request, EntityManagerInterface $manager): Response
    {
        $search = new Search();
        $form = $this->createForm(
            SearchBookType::class,
            $search,
            ['action' => $this->generateUrl('app_result')]
        );
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // fetch some data from the database
            /** @var BookRepository $repository */
            $repository = $manager->getRepository(Book::class);
            $result = $repository->findAllBooksByQuery($search->getQuery());

            return $this->render('book/index.html.twig', [
                'books' => $result,
            ]);
        }

        throw $this->createNotFoundException('The page you are looking for does not exist');
    }
}

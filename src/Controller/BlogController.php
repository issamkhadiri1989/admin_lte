<?php

namespace App\Controller;

use App\Entity\Blog;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class BlogController extends AbstractController
{
    #[Route('/blog/{id}/edit', name: 'app_blog_show')]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function index(Blog $blog): Response
    {
        return $this->render('blog/index.html.twig', [
            'blog' => $blog,
        ]);
    }
}

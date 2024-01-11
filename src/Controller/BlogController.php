<?php

namespace App\Controller;

use App\Entity\Blog;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class BlogController extends AbstractController
{
    #[Route('/blog/{id}/edit', name: 'app_blog_edit')]
    #[IsGranted(attribute: 'can_edit_blog', subject: 'blog')]
    public function edit(Blog $blog): Response
    {
        return $this->render('blog/index.html.twig', [
            'blog' => $blog,
            'title' => 'Edit Blog',
        ]);
    }

    #[Route('/blog/{id}/view', name: 'app_blog_view')]
    #[IsGranted(attribute: 'can_view_blog', subject: 'blog')]
    public function view(Blog $blog): Response
    {
        return $this->render('blog/index.html.twig', [
            'blog' => $blog,
            'title' => 'View Blog',
        ]);
    }
}

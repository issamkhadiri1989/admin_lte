<?php

namespace App\Controller;

use App\Entity\Blog;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_default')]
    public function index(EntityManagerInterface $manager): Response
    {
        $blogRepository = $manager->getRepository(Blog::class);

        $publishedBlogs = $blogRepository->findBy(['draft' => false]);

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'blogs' => $publishedBlogs,
        ]);
    }

    #[Route('/blogs/{slug}', name: 'app_show_blog')]
    public function showBlog(Blog $blog): Response
    {
        if ($blog->isDraft() === true) {
            throw $this->createNotFoundException('This page is not found');
        }

        return $this->render('default/blog.html.twig', [
            'controller_name' => 'DefaultController',
            'blog' => $blog,
        ]);
    }
}

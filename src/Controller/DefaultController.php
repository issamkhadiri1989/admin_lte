<?php

namespace App\Controller;

use App\Entity\Category;
use App\Factory\CategoryFactory;
use App\Order\OrderCheckout;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    public function __construct(private OrderCheckout $orderCheckout)
    {
    }

    #[Route('/default', name: 'app_default')]
    public function index(EntityManagerInterface $objectManager): Response
    {
        $repository = $objectManager->getRepository(Category::class);

        $this->orderCheckout->checkout();

/*        $categories = $repository->findAll();

        foreach ($categories as $item) {
            dump($item);
        }*/

        $category = $repository->find(2);

        dump($category);

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
}

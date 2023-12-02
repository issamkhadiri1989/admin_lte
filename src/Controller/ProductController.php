<?php

declare(strict_types=1);

namespace App\Controller;

use App\Form\Type\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: "/product", name: "app_product_")]
class ProductController extends AbstractController
{
    #[Route("/add", name: "add")]
    public function addProduct(): Response
    {
        $form = $this->createForm(ProductType::class,);

        return $this->render('product/add.html.twig', ['addProductForm' => $form,]);
    }
}
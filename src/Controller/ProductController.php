<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Product;
use App\Form\Type\ProductType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: "/product", name: "app_product_")]
class ProductController extends AbstractController
{
    #[Route(path: "/add", name: "add")]
    public function addProduct(Request $request, EntityManagerInterface $manager): Response
    {
        $product = new Product();
        $product->setDescription('some dummy description');

        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            // do some logic
            $data = $form->getData(); // data of the form
//            $manager->persist($data);
//            $manager->flush();
            dd($data,$product);
        }

        return $this->render('product/add.html.twig', ['addProductForm' => $form]);
    }
}
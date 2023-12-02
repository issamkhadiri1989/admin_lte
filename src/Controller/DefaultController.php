<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Student;
use App\Factory\CategoryFactory;
use App\Form\Type\StudentType;
use App\Order\OrderCheckout;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type as Type;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    public function __construct(private OrderCheckout $orderCheckout)
    {
    }

    #[Route('/default', name: 'app_default')]
    public function index(EntityManagerInterface $objectManager, Request $request): Response
    {
        $repository = $objectManager->getRepository(Category::class);

        $this->orderCheckout->checkout();

/*        $categories = $repository->findAll();

        foreach ($categories as $item) {
            dump($item);
        }*/

        $category = $repository->find(2);

        //dump($category);

        $student = new Student();
        $student->setEmail('issam@gmail.com');
        $student->setFullName('Issam KHADIRI');

        $form = $this->createForm(StudentType::class, $student);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            dump($form->getData());
            dump($student);
            $objectManager->persist($form->getData());
            $objectManager->flush();
        }


        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'myForm' => $form,
        ]);
    }
}

<?php

namespace App\Controller;

use App\Entity\Order;
use App\Form\OrderType;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LandingPageController extends AbstractController
{



    #[Route('/', name: 'landing_page')]
    public function index(Request $request, EntityManagerInterface $entityManager, ProductRepository $productRepository): Response
    {
        // Ton code ici
        $order = new Order();
        $form = $this->createForm(OrderType::class, $order);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            // dd($order);
            $order->setStatus('WAITING');
            $entityManager->persist($order);
            $entityManager->flush();
            // persist
            // flush();
        }
    
        return $this->render('landing_page/index_new.html.twig', [
            'form' => $form->createView(),
            'products' => $productRepository->findAll(),
        ]); 
    }





    #[Route('/confirmation', name: 'confirmation')]
    public function confirmation(): Response
    {
        return $this->render('landing_page/confirmation.html.twig');
    }
}
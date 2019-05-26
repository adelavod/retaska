<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProductRepository;



class HomepageController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(ProductRepository $productRepository)
    {
        return $this->render('homepage/index.html.twig', [
            'controller_name' => 'HomepageController',
            'products' => $productRepository->findWishlist()
        ]);
    }


}

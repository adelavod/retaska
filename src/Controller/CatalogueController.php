<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CatalogueController extends AbstractController
{
    /**
     * @Route("/catalogue", name="catalogue", methods={"GET"})
     */

    public function catalogue(ProductRepository $productRepository): Response
    {
        return $this->render('catalogue/index.html.twig', [
            'products' => $productRepository->findAll(),
        ]);
    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Product;

class CatalogueDetailController extends AbstractController
{
    /**
     * @Route("/catalogue/detail/{id}", name="catalogue_detail", methods={"GET"})
     */

    public function show(Product $product): Response
    {
        return $this->render('catalogue_detail/show.html.twig', [
            'product' => $product,
        ]);
    }
}

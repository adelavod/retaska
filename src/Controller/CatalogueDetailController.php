<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CatalogueDetailController extends AbstractController
{
    /**
     * @Route("/catalogue/detail", name="catalogue_detail")
     */
    public function index()
    {
        return $this->render('catalogue_detail/index.html.twig', [
            'controller_name' => 'CatalogueDetailController',
        ]);
    }
}

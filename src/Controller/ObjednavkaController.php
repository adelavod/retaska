<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ObjednavkaController extends AbstractController
{
    /**
     * @Route("/objednavka", name="objednavka")
     */
    public function index()
    {
        return $this->render('objednavka/index.html.twig', [
            'controller_name' => 'ObjednavkaController',
        ]);
    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Product;

class KosikController extends AbstractController
{

    /**
     * @Route("/basket-add/{id}", name="kosik_add")
     */
    public function add(Product $product, SessionInterface $session)
    {
        $kosik = $session->get('kosik', []);

        $kosik[$product->getId()] = [
            'id'=> $product->getId(),
            'name'=>$product->getName(),
            'price'=> $product->getPrice(),
            'amount'=>1
        ];

        $session->set('kosik', $kosik);

        return $this->redirectToRoute('kosik');
    }

    /**
     * @Route("/basket-amountplus/{id}", name="kosik_amountplus")
     */
    public function amountplus(Product $product, SessionInterface $session)
    {
        $kosik = $session->get('kosik', []);

        $kosik[$product->getId()] ['amount']++;
        $session->set('kosik', $kosik);

        return $this->redirectToRoute('kosik');
    }

    /**
     * @Route("/basket-amountminus/{id}", name="kosik_amountminus")
     */
    public function amountminus(Product $product, SessionInterface $session)
    {
        $kosik = $session->get('kosik', []);

        $kosik[$product->getId()] ['amount']--;
        $session->set('kosik', $kosik);

        return $this->redirectToRoute('kosik');
    }

    // OBOJE MOZNOSTI V JEDNE METODE:
    /**
     * @Route("/basket-changeamount/{id}/{mode}", name="kosik_changeamount")
     *
     * public function changeAmount(Product $product, SessionInterface $session, $mode)
    {
    $kosik = $session->get('kosik', []);

    if ($mode === 1){$kosik[$product->getId()] ['amount']--;}
    else {$kosik[$product->getId()] ['amount']++;}

    $session->set('kosik', $kosik);

    return $this->redirectToRoute('kosik');
    }
     *
     *
     *
     *
     */


    /**
     * @Route("/kosik", name="kosik")
     */
    public function index(SessionInterface $session)
    {
        $kosik = $session->get('kosik', []);

        return $this->render('kosik/index.html.twig', [
'kosik'=> $kosik
        ]);
    }
}
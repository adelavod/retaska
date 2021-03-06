<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Product;

class KosikController extends AbstractController
{
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

    /**
     * @Route("/basket-add/{id}", name="kosik_add")
     */
    public function add(Product $product, SessionInterface $session, Request $request)
    {
        $amount = 1;
        $price = $product->getPrice();
        $priceamount = $price * $amount;

        $kosik = $session->get('kosik', []);

        // Chci dát do array košíku výpočet ceny za produkt cena * množství

        $kosik[$product->getId()] = [
            'id'=> $product->getId(),
            'name'=>$product->getName(),
            'price'=> $product->getPrice(),
            'amount'=>$amount,
            'priceamount'=>$priceamount,
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

        // aktualizace proměnné priceamount po každém zvýšení a snížení ks produktu v košíku
        $amount = $kosik[$product->getId()] ['amount'];
        $price = $product->getPrice();
        $priceamount = $price * $amount;
        $kosik[$product->getId()]['priceamount'] = $priceamount;
        $session->set('kosik', $kosik);

        return $this->redirectToRoute('kosik');
    }

    /**
     * @Route("/basket-amountminus/{id}", name="kosik_amountminus")
     */
    public function amountminus(Product $product, SessionInterface $session)
    {
        $kosik = $session->get('kosik', []);

        // pokud je po uprave pocet 0, odebere se cely produkt:

        if ($kosik[$product->getId()]['amount'] == 1)
        {
            unset($kosik[$product->getId()]);
        } else {
            $kosik[$product->getId()] ['amount']--;

            //aktualizace promenne priceamount po snizeni poctu ks v kosiku:
            $amount = $kosik[$product->getId()] ['amount'];
            $price = $product->getPrice();
            $priceamount = $price * $amount;
            $kosik[$product->getId()]['priceamount'] = $priceamount;

        }

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
     * @Route("/basket-empty/", name="kosik_empty")
     */
    public function vyprazdniKosik(SessionInterface $session)
    {
        $kosik = [];
        $session->set('kosik', $kosik);
        return $this->redirectToRoute('kosik', [

        ]);
    }

}

<?php
namespace App\Controller;
use App\Entity\Objednavka;
use App\Entity\Payment;
use App\Entity\Product;
use App\Form\ObjednavkaType;
use App\Form\ProductType;
use App\Repository\PaymentRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\KosikController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
/**
 * @Route("/catalogue")
 */
class CatalogueController extends AbstractController
{
    /**
     * @Route("/", name="catalogue", methods={"GET"})
     */
    public function catalogue(ProductRepository $productRepository): Response
    {
        return $this->render('catalogue/index.html.twig', [
            'products' => $productRepository->findAll(),
        ]);
    }

    /**
     * @Route("/thankyou", name="thankyou", methods={"GET"})
     */
    public function thankyou(ProductRepository $productRepository): Response
    {
        return $this->render('objednavka/thankyou.html.twig', [
            //* sem se dá dát nějaká funkce kdyžtak //
        ]);
    }
    /**
     * @Route("/{id}/objednat", name="novaobjednavka", methods={"GET","POST"})
     */
    public function new(Request $request, Product $product, PaymentRepository $paymentRepository, SessionInterface $session): Response
    {
        $objednavka = new Objednavka();
        $form = $this->createForm(ObjednavkaType::class, $objednavka);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

       /*
        *   $products = $session->get('kosik');

            foreach ($products as $product){
                $product = new OrderProduct;
                $product ->setId($product['id']);
                $product ->setName($product['name']);
                $product ->setPrice($product['price']);
                $product ->setAmount($product['amount']);

                $order->addProduct($product);
            }
        */


            $objednavka->setProduct($product);

            $objednavka->setTotalprice($product->getPrice() + $objednavka->getPayment()->getPrice());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($objednavka);
            $entityManager->flush();
            return $this->redirectToRoute('thankyou');
        }
        return $this->render('objednavka/new.html.twig', [
            'objednavka' => $objednavka,
            'form' => $form->createView(),
            'product' => $product,
            'payment' => $paymentRepository->findAll(),
            'cenazaprodukt' => $product->getPrice(),
            'products' => $session -> get('kosik', [])
        ]);
    }


}
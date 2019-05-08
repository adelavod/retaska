<?php
namespace App\Controller;
use App\Entity\Objednavka;
use App\Entity\Product;
use App\Form\ObjednavkaType;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
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
     * @Route("/objednat", name="novaobjednavka", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $objednavka = new Objednavka();
        $form = $this->createForm(ObjednavkaType::class, $objednavka);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($objednavka);
            $entityManager->flush();
            return $this->redirectToRoute('thankyou');
        }
        return $this->render('objednavka/new.html.twig', [
            'objednavka' => $objednavka,
            'form' => $form->createView(),
        ]);
    }
}
<?php

namespace App\Controller;

use App\Entity\Objednani;
use App\Form\ObjednaniType;
use App\Repository\ObjednaniRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;


class ObjednaniController extends AbstractController
{
    /**
     * @Route("/admin/objednani", name="objednani_index", methods={"GET"})
     */
    public function index(ObjednaniRepository $objednaniRepository): Response
    {
        return $this->render('objednani/index.html.twig', [
            'objednanis' => $objednaniRepository->findAll(),

        ]);
    }

    /**
     * @Route("/objednani/new", name="objednani_new", methods={"GET","POST"})
     */
    public function new(Request $request, SessionInterface $session, ProductRepository $productRepository): Response
    {
        $objednani = new Objednani();
        $objednaneProdukty = $session->get('kosik');

        $form = $this->createForm(ObjednaniType::class, $objednani);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $objednani->setProducts($objednaneProdukty);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($objednani);
            
            $entityManager->flush();

            return $this->redirectToRoute('objednani_index');

        }

        return $this->render('objednani/new.html.twig', [
            'objednani' => $objednani,
            'form' => $form->createView(),
            'kosik' => $objednaneProdukty,
        ]);
    }

    /**
     * @Route("/{id}", name="objednani_show", methods={"GET"})
     */
    public function show(Objednani $objednani): Response
    {
        return $this->render('objednani/show.html.twig', [
            'objednani' => $objednani,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="objednani_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Objednani $objednani): Response
    {
        $form = $this->createForm(ObjednaniType::class, $objednani);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('objednani_index', [
                'id' => $objednani->getId(),
            ]);
        }

        return $this->render('objednani/edit.html.twig', [
            'objednani' => $objednani,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="objednani_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Objednani $objednani): Response
    {
        if ($this->isCsrfTokenValid('delete'.$objednani->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($objednani);
            $entityManager->flush();
        }

        return $this->redirectToRoute('objednani_index');
    }
}

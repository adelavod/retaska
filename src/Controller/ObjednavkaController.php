<?php

namespace App\Controller;

use App\Entity\Objednavka;
use App\Form\ObjednavkaType;
use App\Repository\ObjednavkaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/objednavka")
 */
class ObjednavkaController extends AbstractController
{
    /**
     * @Route("/", name="objednavka_index", methods={"GET"})
     */
    public function index(ObjednavkaRepository $objednavkaRepository): Response
    {
        return $this->render('objednavka/index.html.twig', [
            'objednavkas' => $objednavkaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="objednavka_new", methods={"GET","POST"})
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

            return $this->redirectToRoute('objednavka_index');
        }

        return $this->render('objednavka/new.html.twig', [
            'objednavka' => $objednavka,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="objednavka_show", methods={"GET"})
     */
    public function show(Objednavka $objednavka): Response
    {
        return $this->render('objednavka/show.html.twig', [
            'objednavka' => $objednavka,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="objednavka_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Objednavka $objednavka): Response
    {
        $form = $this->createForm(ObjednavkaType::class, $objednavka);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('objednavka_index', [
                'id' => $objednavka->getId(),
            ]);
        }

        return $this->render('objednavka/edit.html.twig', [
            'objednavka' => $objednavka,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="objednavka_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Objednavka $objednavka): Response
    {
        if ($this->isCsrfTokenValid('delete'.$objednavka->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($objednavka);
            $entityManager->flush();
        }

        return $this->redirectToRoute('objednavka_index');
    }
}

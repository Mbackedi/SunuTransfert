<?php

namespace App\Controller;

use App\Entity\Compte;
use App\Repository\CompteRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/api")
 */
class CompteController extends AbstractController
{
    /**
     * @Route("/compte", name="compte_index", methods={"GET"})
     */
    public function index(CompteRepository $compteRepository): Response
    {
        return $this->render('compte/index.html.twig', [
            'comptes' => $compteRepository->findAll(),
        ]);
    }



    /**
     *@Route("/listercompte", name="list_compte", methods={"GET"})
     */
    public function listercompte(CompteRepository $compteRepository, SerializerInterface $serializer)
    {
        $compte = $compteRepository->findAll();
        $data = $serializer->serialize($compte, 'json');

        return new Response($data, 200, [
            'Content-Type' => 'application/json'
        ]);
    }



    /**
     * @Route("/new", name="compte_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $compte = new Compte();
        $form = $this->createForm(CompteType::class, $compte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($compte);
            $entityManager->flush();

            return $this->redirectToRoute('compte_index');
        }

        return $this->render('compte/new.html.twig', [
            'compte' => $compte,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="compte_show", methods={"GET"})
     */
    public function show(Compte $compte): Response
    {
        return $this->render('compte/show.html.twig', [
            'compte' => $compte,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="compte_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Compte $compte): Response
    {
        $form = $this->createForm(CompteType::class, $compte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('compte_index');
        }

        return $this->render('compte/edit.html.twig', [
            'compte' => $compte,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="compte_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Compte $compte): Response
    {
        if ($this->isCsrfTokenValid('delete' . $compte->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($compte);
            $entityManager->flush();
        }

        return $this->redirectToRoute('compte_index');
    }
}

<?php

namespace App\Controller;

use App\Entity\Restaurantes;
use App\Form\RestaurantesType;
use App\Repository\RestaurantesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/restaurantes")
 */
class RestaurantesController extends AbstractController
{
    /**
     * @Route("/", name="restaurantes_index", methods={"GET"})
     */
    public function index(RestaurantesRepository $restaurantesRepository): Response
    {
        return $this->render('restaurantes/index.html.twig', [
            'restaurantes' => $restaurantesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="restaurantes_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $restaurante = new Restaurantes();
        $form = $this->createForm(RestaurantesType::class, $restaurante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($restaurante);
            $entityManager->flush();

            return $this->redirectToRoute('restaurantes_index');
        }

        return $this->render('restaurantes/new.html.twig', [
            'restaurante' => $restaurante,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="restaurantes_show", methods={"GET"})
     */
    public function show(Restaurantes $restaurante): Response
    {
        return $this->render('restaurantes/show.html.twig', [
            'restaurante' => $restaurante,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="restaurantes_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Restaurantes $restaurante): Response
    {
        $form = $this->createForm(RestaurantesType::class, $restaurante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('restaurantes_index');
        }

        return $this->render('restaurantes/edit.html.twig', [
            'restaurante' => $restaurante,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="restaurantes_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Restaurantes $restaurante): Response
    {
        if ($this->isCsrfTokenValid('delete'.$restaurante->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($restaurante);
            $entityManager->flush();
        }

        return $this->redirectToRoute('restaurantes_index');
    }

    public function __toString(){
        return (string)$this->CodRes;
    }
}

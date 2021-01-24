<?php

namespace App\Controller;

use App\Entity\Productos;
use App\Entity\Categorias;
use App\Form\ProductosType;
use App\Controller\CategoriasController;
use App\Controller\CarritoController;
use App\Repository\ProductosRepository;
use App\Repository\CategoriasRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/productos")
 */
class ProductosController extends AbstractController
{
    /**
     * @Route("/{categoriaid}", name="productos_index", methods={"GET"})
     */
    public function index(ProductosRepository $productosRepository): Response
    {
        $categoriaid=0;
        if(isset($_GET['categoriaid'])){ 
            $categoriaid = $_GET['categoriaid'];
            $em = $this->getDoctrine()->getManager();
            $productos = $this->getDoctrine()
            ->getRepository(Categorias::class)
            ->find($categoriaid)
            ->getProductos();
            return $this->render('productos/index.html.twig', [
                'filtrado'=> $categoriaid,
                'productos' => $productos,
            ]);
        }
        else{
            return $this->render('productos/index.html.twig', [
                'filtrado'=> $categoriaid,
                'productos' => $productosRepository->findAll(),
            ]);
        }
            
    }

    /**
     * @Route("/new", name="productos_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $producto = new Productos();
        $form = $this->createForm(ProductosType::class, $producto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($producto);
            $entityManager->flush();

            return $this->redirectToRoute('productos_index');
        }

        return $this->render('productos/new.html.twig', [
            'producto' => $producto,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="productos_show", methods={"GET"})
     */
    public function show(Productos $producto): Response
    {
        return $this->render('productos/show.html.twig', [
            'producto' => $producto,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="productos_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Productos $producto): Response
    {
        $form = $this->createForm(ProductosType::class, $producto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('productos_index');
        }

        return $this->render('productos/edit.html.twig', [
            'producto' => $producto,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="productos_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Productos $producto): Response
    {
        if ($this->isCsrfTokenValid('delete'.$producto->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($producto);
            $entityManager->flush();
        }

        return $this->redirectToRoute('productos_index');
    }
}

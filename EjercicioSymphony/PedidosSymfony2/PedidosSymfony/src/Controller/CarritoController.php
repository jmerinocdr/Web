<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarritoController extends AbstractController
{
    /**
     * @Route("/carrito", name="carrito")
     */
    public function index(): Response
    {
        return $this->render('carrito/index.html.twig', [
            'controller_name' => 'CarritoController',
        ]);
    }
    
    /**
    * @Route("/anadir", name="anadir")
    */
    public function anadir(SessionInterface $session) {
        $id = $_POST['cod'];
        $unidades= $_POST['unidades'];
        $carrito = $session->get('carrito');
        if(is_null($carrito)){
            $carrito = array();
        }
        if(isset($carrito[$id])){
            $carrito[$id]['unidades'] += intval($unidades);
        }else{
            $carrito[$id]['unidades'] = intval($unidades);
        }
        $session->set('carrito', $carrito);
        return $this->redirectToRoute('carrito');
    }
}

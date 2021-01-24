<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/default", name="default")
     */
    public function index(): Response
    {
        if($this->isGranted('ROLE_USER')){
            return $this->redirectToRoute('categorias_index');
        }
        else{
            return $this->render('default/index.html.twig', [
                'controller_name' => 'DefaultController',
            ]);
        }
    }
}

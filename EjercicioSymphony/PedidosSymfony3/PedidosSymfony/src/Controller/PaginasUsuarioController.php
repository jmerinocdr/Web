<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\CategoriaController;
/*use Symfony\Component\Validator\Constraints\Email;*/
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Pedido;
use App\Entity\Categoria;
use App\Entity\Producto;
use App\Entity\User;
use App\Repository\CategoriaRepository;
use App\Repository\ProductoRepository;

/**
 * @Route("/paginas_usuario")
 */
class PaginasUsuarioController extends AbstractController
{
    /**
     * @Route("/categoria_lista", name="categoria_lista")
     */
    public function categoria_lista(CategoriaRepository $categoriaRepository): Response
    {
        return $this->render('paginas_usuario/categoria_lista.html.twig', [
            'categorias' => $categoriaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/producto_lista/{categoriaid}", name="producto_lista", methods={"GET"})
     */
    public function producto_lista(ProductoRepository $productoRepository, int $categoriaid): Response
    {  
        if($categoriaid){
            $em = $this->getDoctrine()->getManager();
            $productos = $this->getDoctrine()
                ->getRepository(Categoria::class)
                ->find($categoriaid)
                ->getProducto();
            return $this->render('paginas_usuario/producto_lista.html.twig', [
                'categoriaid' => $categoriaid,
                'productos' => $productos,
            ]);
        }
        else{
            return $this->render('paginas_usuario/producto_lista.html.twig', [
                'categoriaid' => '0',
                'productos' => $productoRepository->findAll(),
            ]);
        }
    }

    /**
    * @Route("/anadir_carrito", name="anadir_carrito")
    */
    public function anadir_carrito(SessionInterface $session) {
        $id = $_POST['id'];
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
        return $this->redirectToRoute('ver_carrito');
    }

    /**
    * @Route("/eliminar_carrito", name="eliminar_carrito")
    */
    public function eliminar_carrito(SessionInterface $session){
        $id = $_POST['id'];
        $unidades= $_POST['unidades'];
        $carrito = $session->get('carrito');
        if(is_null($carrito)){
            $carrito = array();
        }
        if(isset($carrito[$id])){
            $carrito[$id]['unidades'] -= intval($unidades);
        if($carrito[$id]['unidades'] <= 0) {
            unset($carrito[$id]);
        }
        }
        $session->set('carrito', $carrito);
        return $this->redirectToRoute('carrito');
    }

    /**
    * @Route("/ver_carrito", name="ver_carrito")
    */
    public function ver_Carrito(SessionInterface $session){
        /* para cada elemento del carrito se consulta la base de datos y se
        recuperan sus datos*/
        $productos = [];
        $carrito = $session->get('carrito');
        
        /* si el carrito no existe se crea como un array vacío*/
        if(is_null($carrito)){
            $carrito = array();
            $session->set('carrito', $carrito);
        }
        
        /* se crea array con todos los datos de los productos y la canti-
        dad*/
        
        foreach ($carrito as $codigo => $cantidad){
            $producto = $this->getDoctrine()
            ->getRepository(Producto::class)
            ->find((int)$codigo);
            $elem = [];
            $elem['id'] = $producto->getId();
            $elem['nombre'] = $producto->getNombre();
            $elem['peso'] = $producto->getPeso();
            $elem['precio'] = $producto->getPrecio();
            $elem['stock'] = $producto->getStock();
            $elem['descripcion'] = $producto->getDescripcion();
            $elem['unidades'] = implode($cantidad);
            $productos[] = $elem;
        }
        return $this->render("paginas_usuario/carrito.html.twig", [
            'productos'=>$productos,
        ]);
    }

    /**
    * @Route("/hacer_pedido", name="hacer_pedido")
    *
    */
    public function hacer_pedido(SessionInterface $session, MailerInterface $mailer) {
    $entityManager = $this->getDoctrine()->getManager();
    $carrito = $session->get('carrito');
    /* si el carrito no existe, o está vacío*/
    /*||count($carrito)==0*/
    if(is_null($carrito)||count($carrito)==0 ){
        return $this->render("paginas_usuario/pedido.html.twig",
        array('error'=>1));
    }
    else{
        #crear un nuevo pedido
        $pedido = new Pedido();
        $pedido->setFecha(new \DateTime());
        $pedido->setPeso(0);
        $pedido->setPrecio(0);
        $pedido->setEnviado(0);
        $pedido->setUser($this->getUser());
        $entityManager->persist($pedido);
        #recorrer carrito creando nuevos pedidoproducto
        foreach ($carrito as $codigo => $cantidad){
            $producto = $this->getDoctrine()
                ->getRepository(Producto::class)
                ->find($codigo);
            $pedido->addProducto($producto);
            //actualizar el stock
            $cantidad = implode($cantidad);
            $query = $entityManager->createQuery(
                "UPDATE App\Entity\Producto p
                SET p.Stock = p.Stock - $cantidad
                WHERE p.id = $codigo");
            $resul = $query->getResult();
        }
    }
    /*si hay error con la BD,
    Muestra plantilla con el código adecuado*/
    try{
    $entityManager->flush();
    }catch (Exception $e) {
    return $this->render("paginas_usuario/pedido.html.twig",
    array( 'error'=>2));
    }
    /*prepara el array de productos para la plantilla*/
    foreach ($carrito as $codigo => $cantidad){
    $producto = $this->getDoctrine()
    ->getRepository(Producto::class)
    ->find((int)$codigo);
    $elem = [];
    $elem['id'] = $producto->getId();
    $elem['nombre'] = $producto->getNombre();
    $elem['peso'] = $producto->getPeso();
    $elem['stock'] = $producto->getStock();
    $elem['descripcion'] = $producto->getDescripcion();
    $elem['unidades'] = implode($cantidad);
    $productos[] = $elem;
    }
    //vaciar el carrito
    $session->set('carrito', array());

    /* mandar el correo */
    $message = (new Email())
    ->from('jmerino.cdr@gmail.com')
    ->to($this->getUser()->getEmail())
    ->subject("Pedido ". $pedido->getId(). "confirmado")
    ->html($this->renderView('paginas_usuario/correo.html.twig',
    array('id'=>$pedido->getId(),
    'productos'=> $productos)),
    'text/html');
    $mailer->send($message);
    return $this->render("paginas_usuario/pedido.html.twig",
    array('error'=>0,'id'=>$pedido->getId(),
    'productos'=> $productos));
    }
}

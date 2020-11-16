<?php
require_once "../bootstrap.php";
if(!empty($_POST('accion'))){
    $accion=$_POST('accion');
    $datos=$_POST('datos');
    if($datos='array'){
        $id=$_POST('id');
        $nombre=$_POST('nombre');
    }
    else{
        $id=$_POST('id');
    }
    switch($_POST('accion')){
        case 'add':
            $deporte = new Deporte($nombre);

            $entityManager->persist($deporte);
            $entityManager->flush();

            echo "Created Sport ".$deporte->getNombre()." with ID " . $deporte->getId() . "\n";
        break;
        case 'del':
            $deporte = $entityManager->find('Deporte', $id);
            if ($deporte === null) {
                echo "No Sport found.\n";
                exit(1);
            }
            $entityManager->remove($deporte);
            $entityManager->flush();

        break;
        case 'mod':
            $deporte = $entityManager->find('Deporte', $id);
            if ($deporte === null) {
                 echo "Sport $id does not exist.\n";
                exit(1);
            }
            $deporte->setNombre($nombre);
            $deporte->setFnacimiento($fnacimiento);
            $deporte->setSexo($sexo);
            $deporte->setDeportes($deportes);
            $deporte->setFoto($foto);
            $entityManager->flush();
        break;
        case 'mostrarTodos':
            $deporteRepository = $entityManager->getRepository('Deporte');
            $deportes = $productRepository->findAll();

            foreach ($deportes as $deporte) {
                echo "<tr>";
                    echo "<td>".$deporte->getNombre()."<td>";
                echo "</tr>";
            }
        break;
        case 'mostrarUno':
            $deporte = $entityManager->find('deporte', $id);
            if ($deporte === null) {
                echo "No User found.\n";
                exit(1);
            }
            echo "<tr>";
                echo "<td>".$deporte->getNombre()."<td>";
            echo "</tr>";
        break;
    }
}
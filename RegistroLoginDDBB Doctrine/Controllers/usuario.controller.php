<?php
require_once "../bootstrap.php";
if(!empty($_POST['accion'])){
    $accion=$_POST['accion'];
    $datos=$_POST['datos'];
    if($datos="array"){
        $id=$_POST['id'];
        $nombre=$_POST['nombre'];
        $fnacimiento=$_POST['fnacimiento'];
        $sexo=$_POST['sexo'];
        $foto=$_POST['foto'];
    }
    else if($datos="id"){
        $id=$_POST['id'];
    }
    switch($_POST['accion']){
        case 'add':
            $usuario = new Usuario($nombre, $fnacimiento, $sexo, $deportes, $foto);
            $entityManager->persist($usuario);
            $entityManager->flush();

            echo "Created User ".$usuario->getNombre()." with ID " . $usuario->getId() . "\n";
        break;
        case 'del':
            $usuario = $entityManager->find('Usuario', $id);
            if ($usuario === null) {
                echo "No User found.\n";
                exit(1);
            }
            $entityManager->remove($usuario);
            $entityManager->flush();

        break;
        case 'mod':
            $usurio = $entityManager->find('Usuario', $id);
            if ($usuario === null) {
                 echo "User $id does not exist.\n";
                exit(1);
            }
            $usuario->setNombre($nombre);
            $usuario->setFnacimiento($fnacimiento);
            $usuario->setSexo($sexo);
            $usuario->setDeportes($deportes);
            $usuario->setFoto($foto);
            $entityManager->flush();
        break;
        case 'mostrarTodos':
            $usuarioRepository = $entityManager->getRepository('Usuario');
            $usuarios = $usuarioRepository->findAll();

            foreach ($usuarios as $usuario) {
                echo "<tr>";
                    echo "<td>".$usuario->getId()."</td>";
                    echo "<td>".$usuario->getNombre()."</td>";
                    echo "<td>".date_format($usuario->getFnacimiento(), 'd-m-Y')."</td>";
                    echo "<td>".$usuario->getSexo()."</td>";
                    var_dump($usuario->getDeportes());
                    echo "<td>".$usuario->getDeportes()."</td>";
                    echo "<td>".$usuario->getFoto()."</td>";
                echo "</tr>";
            }
        break;
        case 'mostrarUno':
            $usuario = $entityManager->find('Usuario', $id);
            if ($usuario === null) {
                echo "No User found.\n";
                exit(1);
            }
            echo "<tr>";
                echo "<td>".$usuario->getNombre()."<td>";
                echo "<td>".$usuario->getFnacimiento()."<td>";
                echo "<td>".$usuario->getSexo()."<td>";
                echo "<td>".$usuario->getDeportes()."<td>";
                echo "<td>".$usuario->getFoto()."<td>";
            echo "</tr>";
        break;
    }
}
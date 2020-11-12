<?php
require_once "../bootstrap.php";
if(!empty($_POST('accion'))){
    $accion=$_POST('accion');
    $datos=$_POST('datos');
    
    $nombre=$_POST('nombre');
    $contrasena=$_POST('contrasena');

    switch($_POST('accion')){
        case 'add':
            $passwd = new Passwd($nombre, $contrasena);

            $entityManager->persist($passwd);
            $entityManager->flush();

            echo "Created User ".$passwd->getNombre()." with password " . $passwd->getContrasena() . "\n";
        break;
        case 'del':
            $passwd = $entityManager->find('Passwd', $nombre);
            if ($passwd === null) {
                echo "No User found.\n";
                exit(1);
            }
            $entityManager->remove($passwd);
            $entityManager->flush();

        break;
        case 'mod':
            $usurio = $entityManager->find('Passwd', $nombre);
            if ($passwd === null) {
                 echo "User $nombre does not exist.\n";
                exit(1);
            }
            $passwd->setNombre($nombre);
            $passwd->setContrasena($contrasena);
            
            $entityManager->flush();
        break;
        case 'mostrarTodos':
            $passwdRepository = $entityManager->getRepository('Passwd');
            $passwds = $productRepository->findAll();

            foreach ($passwds as $passwd) {
                echo "<tr>";
                    echo "<td>".$passwd->getNombre()."</td>";
                    echo "<td>".$passwd->getContrasena()."</td>";
                echo "</tr>";
            }
        break;
        case 'mostrarUno':
            $passwd = $entityManager->find('Passwd', $nombre);
            if ($passwd === null) {
                echo "No User found.\n";
                exit(1);
            }
            echo "<tr>";
                echo "<td>".$passwd->getNombre()."</td>";
                echo "<td>".$passwd->getContrasena()."</td>";
            echo "</tr>";
        break;
        case 'loginPsw':
            $passwd = $entityManager->find('Passwd', $nombre);
            if ($passwd === null) {
                echo "No User found.\n";
                exit(1);
            }
            if($passwd->getContrasena()==$contrasena){
                echo "Accedido correctamente con el usuario ".$passwd->getNombre();
                session_start();
                // Guardar datos de sesión
                $_SESSION["usuario"] = $passwd->getNombre();
                $_SESSION["validado"] = true;
            }
        break;
    }
}
<?php
    require_once('lib.php');
    $db=new DAO($service, $user, $pass, $host, $dbname);
    echo "Se ha creado el nuevo dao con los datos".$service.$user.$pass.$host,$dbname;
    $db->conectar();
	if($db->dbExist()){
        $user=$_POST["user"];
        $password=$_POST["password"];
        if($db->comprobarPswrd($user, $password)){
            session_start();
            // Guardar datos de sesión
            $_SESSION["usuario"] = $_POST["user"];
            $_SESSION["autorizado"] = "true";
            session_regenerate_id();
            echo "Accedido correctamente";
            header('Location: ../php/principal.php');
        }
        else{
            echo "Usuario no encontrado o la clave no coincide";
            header('Location: ../Index.php');
        }
    }
    else{
    	echo "La base de datos no existe";
        $db->crearBase();
        header('Location: ../Index.php');
    }

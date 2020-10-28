<?php
	if($db->bbExist){
        $user=$_POST["user"];
        $password=$_POST["password"];
        if($db->comprobarPswrd($user, $password){
            session_start();
            // Guardar datos de sesión
            $_SESSION["usuario"] = $_POST["email"];
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
        header('Location: ../Index.php');
    }

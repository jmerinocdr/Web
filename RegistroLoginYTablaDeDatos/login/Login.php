<?php
	if(file_exists("../usuarios.txt")){
        $fichero='../usuarios.txt';
        $registros = file($fichero);

        /*Se comprueba la información del usuario*/
        $existente=false;
        foreach ($registros as $registro) {
        	$campos=explode(':', $registro);

        	//eliminamos el salto de línea de la contrasena
        	$pcontrasena = preg_replace("/[\r\n|\n|\r]+/", "", $campos[3]);

        	//Comprobamos si el correo y contrasena coinciden
        	if ($campos[2]==$_POST["email"] && $pcontrasena==$_POST["contrasena"]) {
        		session_start();
				// Guardar datos de sesión
				$_SESSION["usuario"] = $_POST["email"];
                $_SESSION["autorizado"] = "true";
                session_regenerate_id();
        		echo "Accedido correctamente";
        		header('location: ../MostrarDatos/MostrarDatos.php');
        		$existente=true;
        	}
        	else{
        	}
        }
        if ($existente==false) {
        	echo "Revisa el correo y contrasena";
        }
        else{
        }
    }
    else{
    	echo "El archivo no existe";
    }
?>
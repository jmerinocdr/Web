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
        		echo "Accedido correctamente";
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
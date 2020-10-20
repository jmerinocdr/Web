<?php
	/*Se comprueba la existencia del archivo de usuarios*/
	if(file_exists("../usuarios.txt")){
        $fichero='../usuarios.txt';
        $registros = file($fichero);
        $existente= false;
        /*Se comprueba que el usuario no esté ya registrado*/
        foreach ($registros as $registro) {
        	$campos=explode(':', $registro);
        	if ($campos[2]==$_POST["email"]) {
        		echo "El correo ya está usado por otra persona";
        		$existente=true;
        	}
        	else if ($campos[0]==$_POST["nombre"] && $campos[1]==$_POST["apellido"]){
        		echo "Esta persona ya está registrada";
        		$existente=true;
        	}
        	else{
        	}
        }
        /*Si el usuario no existe, se añade*/
        if ($existente==false) {
        	echo "Es la primera vez que se registra";
        	if(isset($_POST['nombre'])){
		        //var_dump($_POST);
		        $archivo = fopen("../usuarios.txt", "a") or die("No se ha podido crear el archivo");
		        $nombre = $_POST["nombre"];
		        $apellido = $_POST["apellido"];
		        $email = $_POST["email"];
		        $contrasena=$_POST["contrasena"];
        		$vcontrasena=$_POST["vcontrasena"];
			        if($contrasena!=$vcontrasena){
			        	echo "La contrasena no se verificó correctamente";
			        }
			        else{
			        	$textoescribir = $nombre . ":" . $apellido . ":" . $email . ":" . $contrasena;
			        	fwrite($archivo, $textoescribir.PHP_EOL) or die ("Error escribiendo el archivo");
			        	fclose($archivo);
			        }
    		}
        }
        else{

        }
    }

    /*Si no existe el documento pero el php ha recibido un $_POST, se crea un documento con la información recibida*/
    else if(isset($_POST['nombre'])){
        var_dump($_POST);
        $archivo = fopen("../usuarios.txt", "w+") or die("No se ha podido crear el archivo");
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $email = $_POST["email"];
        $contrasena=$_POST["contrasena"];
        $vcontrasena=$_POST["vcontrasena"];
        if($contrasena!=$vcontrasena){
        	echo "La contrasena no se verificó correctamente";
        }
        else{
        	$textoescribir = $nombre . ":" . $apellido . ":" . $email . ":" . $contrasena;
        	fwrite($archivo, $textoescribir.PHP_EOL) or die ("Error escribiendo el archivo");
        	fclose($archivo);
        	echo "Documento creado y datos añadidos";
        }
    }
    else{

    }
?>
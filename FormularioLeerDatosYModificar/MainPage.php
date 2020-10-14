<?php
    if(file_exists("datos.txt")){
        
    }

    else if(isset( $_POST['nombre']) && isset( $_POST['apellido']) && isset( $_POST['fnacimiento']) && isset( $_POST['deporte']) && isset( $_POST['imagen'])){
        $archivo = fopen("datos.txt") or die("No se ha podido crear el archivo");
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $fnaciminento = $_POST["fnacimiento"];
        $deporte = $_POST["deporte"];
        $imagen = $_POST["imagen"];
        fwrite($archivo, '$nombre, $apellido, $fnacimiento, $deporte, $imagen') or die ("Error escribiendo el archivo");
        fclose($archivo);
    }
    else{
        echo "No hay datos, redirigiendo a la página para introducir datos";
        header('location: IntroducirDatos.php?error=vacío');
    }
?>
<!DOCTYPE html>
<html>
    <title>Formulario escribir datos</title>
    <body>
        
    </body>
</html>


<!DOCTYPE html>
<html>
    <title>Formulario escribir datos</title>
    <body>
<?php
    if(file_exists("datos.txt")){
        $fichero = 'datos.txt';
        $registros = file($fichero);
        echo '<h1>Resumen de personas</h1>';
        foreach ($registros as $registro) {
            $campos = explode(':', $registro);
            echo '<p>'.'Nombre: '.$campos[0].'.'.'</p>';
            echo '<p>'.'Apellido: '.$campos[1].'.'.'</p>';
        }
        //https://informaticapc.com/tutorial-php/manejo-de-archivos.php
        $actual = file_get_contents($fichero);
        
    }
    else{
        echo "No hay datos, redirigiendo a la página para introducir datos";
        header('location: IntroducirDatos.php?error=vacío');
    }
?>
    </body>
</html>


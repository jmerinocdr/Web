<!DOCTYPE html>
<html>
    <title>Formulario escribir datos</title>
    <body>
<?php
    session_start();
    if ($_SESSION["autorizado"] == true) {
        if(file_exists("../datos.txt")){
            $fichero = '../datos.txt';
            $registros = file($fichero);
            echo '<h1>Eliminando persona...</h1>';
            $cont=0;
            var_dump($_POST);
            $nombreeliminar = $_POST["nombreeliminar"];
            $apellidoeliminar = $_POST["apellidoeliminar"];

            foreach ($registros as $registro) {
                $campos = explode(':', $registro);
                if($campos[0]==$nombreeliminar && $campos[1]==$apellidoeliminar){
                    unset($registros[$cont]);
                    file_put_contents("../datos.txt", implode("", $registros));
                    echo 'Persona encontrada y eliminada';
                    header('location: ../MostrarDatos/MostrarDatos.php');
                }
                else{
                    $cont++;
                }
            }
            header('location: ../MostrarDatos/MostrarDatos.php');
            echo '<h1>Persona eliminada fin</h1>';
            //https://informaticapc.com/tutorial-php/manejo-de-archivos.php
        }
        else{
            echo "No hay datos, redirigiendo a la página para introducir datos";
            header('location: IntroducirDatos.html');
        }
    }
    else{
        header('location: ../Index.html');
    }
?>
    </body>
</html>


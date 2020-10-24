<!DOCTYPE html>
<html>
    <title>Formulario escribir datos</title>
    <body>
<?php
    session_start();
    if ($_SESSION["autorizado"] == true) {

        if(file_exists("../datos.txt")){
            //https://informaticapc.com/tutorial-php/manejo-de-archivos.php
            if(isset($_POST['nombre'])){
                //var_dump($_POST);
                $archivo = fopen("../datos.txt", "a") or die("No se ha podido crear el archivo");
                $nombre = $_POST["nombre"];
                $apellido = $_POST["apellido"];
                $fnacimiento = $_POST["fnacimiento"];
                $deportes="";
                $cont=0;
                foreach ($_POST['deporte'] as $depo) {
                    if ($cont==0) {
                        $deportes = $depo;
                        //echo $cont . $depo;
                        $cont++;
                    }
                    else{
                        $deportes = $deportes . ',' . $depo;
                        //echo $cont . $depo;
                    }
                }
                echo $deportes;
                $imagen = $_FILES['fotoperfil']['name'];
        
                //echo $_FILES['fotoperfil']['name'];
                $textoescribir = $nombre . ":" . $apellido . ":" . $fnacimiento . ":" . $deportes . ":" . $imagen;
                fwrite($archivo, $textoescribir.PHP_EOL) or die ("Error escribiendo el archivo");
                fclose($archivo);
                header('location: ../MostrarDatos/MostrarDatos.php');
            }
        }
        else{
            echo "No hay datos, redirigiendo a la página para introducir datos";
            header('location: ../MostrarDatos/IntroducirDatos.html');
        }
    }
    else{
        header('location: ../Index.html');
    }
?>
    </body>
</html>
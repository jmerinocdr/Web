<!--
    Documento principal del Ejercicio
    Este ejercicio consiste de un grupo de páginas php con el fin de crear, leer y modificar un archivo txt
-->
<!DOCTYPE html>
<html>
    <title>Formulario escribir datos</title>
    <body>
<?php
    session_start();
    if ($_SESSION["autorizado"] == true) {

        /*Aquí comprobamos si existe el documento*/
        if(file_exists("../datos.txt")){
            $fichero = '../datos.txt';
            $registros = file($fichero);
            echo '<table border="1">';
            echo '<tr><td>Nombre</td><td>Apellido</td><td>Fecha nacimiento</td><td>Deportes</td><td>Imagen</td></tr>';
            foreach ($registros as $registro) {
                $campos = explode(':', $registro);
                echo '<tr>';
                echo '<td>'.$campos[0].'.'.'</td>';
                echo '<td>'.$campos[1].'.'.'</td>';
                echo '<td>'.$campos[2].'.'.'</td>';
                echo '<td>';
                $dcampos = explode(',', $campos[3]);
                for ($i=0; $i < count($dcampos); $i++) { 
                    if($dcampos[$i] == 'n'){
                        echo 'Natación ';
                    }
                    if($dcampos[$i] == 'b'){
                        echo 'Baloncesto ';
                    }
                    if($dcampos[$i] == 'f'){
                        echo 'Fútbol ';
                    }
                    if($dcampos[$i] == 'c'){
                        echo 'Ciclismo ';
                    }
                    else{
                    }
                }
                echo '</td>';
                echo '<td>'.'Imagen: '.$campos[4].'</td>';
                echo '</tr>';
            }
            echo "</table>";
            echo '<p><a href="../ModificarDatos/ModificarDatos.php">Modificar información</a></p>';
            echo '<p><a href="../AnadirDatos/FormularioAnadirDatos.php">Añadir datos</a></p>';
            echo '<p><a href="../EliminarDatos/FormularioEliminarDatos.php">Eliminar datos</a></p>';
            echo '<p><a href="../Sesion/CerrarSesion.php">Cerrar sesión</a></p>';
        }


        /*Si no existe el documento pero el php ha recibido un $_POST, se crea un documento con la información recibida*/
        else if(isset($_POST['nombre'])){
            //var_dump($_POST);
            $archivo = fopen("../datos.txt", "w+") or die("No se ha podido crear el archivo");
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

            header('location: MostrarDatos.php');

            /*Escribimos los datos recibidos por el $_POST*/

            /*
            echo '<p>'.'Nombre: '.$_POST['nombre'].'.'.'</p>';
                echo '<p>'.'Apellido: '.$_POST['apellido'].'.'.'</p>';
                echo '<p>'.'Fecha nacimiento: '.$_POST['fnacimiento'].'.'.'</p>';
                echo '<p>'.'Deportes: ';
                foreach ($_POST['deporte'] as $depo) {
                if ($depo=='n') {
                    echo "Natación ";
                }
                if ($depo=='b') {
                    echo "Baloncesto ";
                }
                if ($depo=='f') {
                    echo "Fútbol ";
                }
                if ($depo=='c') {
                    echo "Ciclismo ";
                }
                else{
                    
                }
                
            }
            */
                echo '</p>';
                echo '<p>'.'Imagen: '.$_FILES['fotoperfil']['name'];

        }


        /*Si no existe el documento ni el php ha recibido un $_POST, se reenvía al formulario de creación*/
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


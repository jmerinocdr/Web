<!--
    Documento principal del Ejercicio
    Este ejercicio consiste de un grupo de páginas php con el fin de crear, leer y modificar un archivo txt
-->
<!DOCTYPE html>
<html>
    <title>Formulario escribir datos</title>
    <body>
<?php


    /*Aquí comprobamos si existe el documento*/
    if(file_exists("datos.txt")){
        $fichero = 'datos.txt';
        $registros = file($fichero);
        foreach ($registros as $registro) {
            $campos = explode(':', $registro);
            echo '<p>'.'Nombre: '.$campos[0].'.'.'</p>';
            echo '<p>'.'Apellido: '.$campos[1].'.'.'</p>';
            echo '<p>'.'Fecha nacimiento: '.$campos[2].'.'.'</p>';
            echo '<p>'.'Deportes: ';
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
            echo '</p>';
            echo '<p>'.'Imagen: '.$campos[4];
        }
        echo '<p><a href="ModificarDatos.php">Modificar información</a></p>';
        echo '<p><a href="AnadirDatos.php">Añadir datos</a></p>';
        echo '<p><a href="EliminarDatos.php">Eliminar datos</a></p>';
    }


    /*Si no existe el documento pero el php ha recibido un $_POST, se crea un documento con la información recibida*/
    else if(isset($_POST['nombre'])){
        //var_dump($_POST);
        $archivo = fopen("datos.txt", "w+") or die("No se ha podido crear el archivo");
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
        fwrite($archivo, $textoescribir) or die ("Error escribiendo el archivo");
        fclose($archivo);



        /*Escribimos los datos recibidos por el $_POST*/
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
            echo '</p>';
            echo '<p>'.'Imagen: '.$_FILES['fotoperfil']['name'];

    }


    /*Si no existe el documento ni el php ha recibido un $_POST, se reenvía al formulario de creación*/
    else{
        echo "No hay datos, redirigiendo a la página para introducir datos";
        header('location: IntroducirDatos.php?error=vacío');
    }
?>
    </body>
</html>


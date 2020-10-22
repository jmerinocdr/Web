<!DOCTYPE html>
<html>
    <title>Formulario eliminar datos</title>
    <body>
<?php
    session_start();
    if ($_SESSION["autorizado"] == true) {
        if(file_exists("../datos.txt")){
            $fichero = '../datos.txt';
            $registros = file($fichero);
            echo '<h1>Resumen de personas</h1>';
            echo '<table border="1">';
            echo '<tr><td>Nombre</td><td>Apellido</td></tr>';
            foreach ($registros as $registro) {
                $campos = explode(':', $registro);
                echo '<tr>';
                echo '<td>'.$campos[0].'.'.'</td>';
                echo '<td>'.$campos[1].'.'.'</td>';
                echo '</tr>';
            }
            echo '</table>';
            //https://informaticapc.com/tutorial-php/manejo-de-archivos.php
            $actual = file_get_contents($fichero);
            
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
        <h1>Introduce los datos para eliminar la persona</h1>
        <form action="EliminarDatos.php" method="post" enctype="multipart/form-data">
            <p>Nombre de la persona a eliminar: <input type="text" name="nombreeliminar" required></p>
            <p>Apellido de la persona a eliminar: <input type="text" name="apellidoeliminar" required></p>
            <p><input type="submit" value="Eliminar"></p>
		</form>
    </body>
</html>


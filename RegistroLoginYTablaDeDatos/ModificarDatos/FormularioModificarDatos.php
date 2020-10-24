<!DOCTYPE html>
<html>
    <title>Formulario añadir datos</title>
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
            header('location: IntroducirDatos.php?error=vacío');
        }
    }
    else{
        header('location: ../Index.html');
    }
?>
        <form action="FormularioModificacion.php" method="post" enctype="multipart/form-data">
            <h1>Introduce los datos de la persona a modificar</h1>
            <p>Nombre: <input type="text" name="nombre" required></p>
            <p>Apellido: <input type="text" name="apellido" required></p>
            <br>
			<p><input type="submit" value="enviar"></p>
		</form>
    </body>
</html>


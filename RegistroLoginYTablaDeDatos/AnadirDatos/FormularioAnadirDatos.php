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
        <h1>Introduce los datos para la nueva persona</h1>
        <form action="AnadirDatos.php" method="post" enctype="multipart/form-data">
            <p>Nombre: <input type="text" name="nombre" required></p>
            <p>Apellido: <input type="text" name="apellido" required></p>
			<p>Fecha de nacimiento <input type="date" name="fnacimiento" required> </p>
			<p>¿Qué deportes haces?</p>
			<ul>
                <li><p>Natación<input type="checkbox" name="deporte[]" value="n"></p></li>
                <li><p>Baloncesto<input type="checkbox" name="deporte[]" value="b"></p></li>
                <li><p>Futbol<input type="checkbox" name="deporte[]" value="f"></p></li>
                <li><p>Ciclismo<input type="checkbox" name="deporte[]" value="c"></p></li>
            </ul>
			<p>Introduce una foto de perfi <input type="file" name="fotoperfil" id="fotoperfil"></p>
			<p><input type="submit" value="enviar"></p>
		</form>
    </body>
</html>

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
            foreach ($registros as $registro) {
                $campos = explode(':', $registro);
                if($campos[0]==$_POST["nombre"] && $campos[1]==$_POST["apellido"]){
                    $pnombre=$_POST["nombre"];
                    $papellido=$_POST["apellido"];
                    $nombre=$campos[0];
                    $apellido=$campos[1];
                    $fnacimiento=$campos[2];
                    $foto=$campos[4];
                }
                else{
                }
                
            }
            echo '</table>';
            //https://informaticapc.com/tutorial-php/manejo-de-archivos.php
            $actual = file_get_contents($fichero);
            
        }
        else{
            echo "No hay datos, redirigiendo a la página para introducir datos";
            header('location: IntroducirDatos.php?error=vacío');
        }
        echo '
        <form action="ModificarDatos.php" method="post" enctype="multipart/form-data">
            <p><input type="hidden" name="nombre" required value='.$pnombre.'></p>
            <p><input type="hidden" name="apellido" required value='.$papellido.'></p>
            <p>Nombre: <input type="text" name="nombre" required value='.$nombre.'></p>
            <p>Apellido: <input type="text" name="apellido" required value='.$apellido.'></p>
            <p>Fecha de nacimiento <input type="date" name="fnacimiento" required value='.$fnacimiento.'> </p>
            <p>¿Qué deportes haces?</p>
                <ul>
                    <li><p>Natación<input type="checkbox" name="deporte[]" value="n"></p></li>
                    <li><p>Baloncesto<input type="checkbox" name="deporte[]" value="b"></p></li>
                    <li><p>Futbol<input type="checkbox" name="deporte[]" value="f"></p></li>
                    <li><p>Ciclismo<input type="checkbox" name="deporte[]" value="c"></p></li>
                </ul>
            <p>Introduce una foto de perfi <input type="file" name="fotoperfil" id="fotoperfil" value='.$foto.'></p>
            <p><input type="submit" value="enviar"></p>
        </form>
        ';
    }
    else{
        header('location: ../Index.html');
    }
?>
        
    </body>
</html>


<?php
    require_once('lib.php');
    $db=new DAO(SERVICE, USER, PASS, HOST, DBNAME);

	if($db->dbExist()){
        //Si recibe un post con un valor nombre, procede a modificar los datos
        if(isset($_POST['nombre'])){
            $id_usuario = $_POST['id'];
            $nombre = $_POST["nombre"];
            $fnacimiento = $_POST["fnacimiento"];
            $sexo = $_POST['sexo'];
            $imagen = $_FILES['fotoperfil']['name'];
            $datos=[
                'pid' => $id_usuario,
                'nombre' => $nombre,
                'nacido' => $fnacimiento,
                'sexo' => $sexo,
                'foto' => $imagen,
            ];
            $db->modificarDatos('Usuario', $datos);
            $db->eliminarDatos('UsuarioDeporte', $id_usuario);
            escribirDatosDeporte($db, $_POST['deporte']);
            guardarImagen(DIRECTORIO, 'fotoperfil');
            header('location: ../php/principal.php');
        }
        //Si recibe un id de usuario, muestra el formulario de ese
        else if(isset($_POST['id_usuario'])){
            mostrarFormulario($db);
        }
        //Si por algún error se llega a esta página, reenviamos al inicio
        else{
            echo "no se ha pasado ni el id ni más valores";
            header('Location: ../Index.php');
        }
    }
    //Si la base de datos no existe, se crea
    else{
    	echo "La base de datos no existe";
        $db->crearBase();
        header('Location: ../Index.php');
    }


    //Esta función muestra el formulario para modificar los datos del usuario
    function mostrarFormulario($db){
        $usuarios = $db->leerDatos('Usuario');
            foreach ($usuarios as $usuario) {
                if ($usuario['id'] == $_POST['id_usuario']) {
                    $id_usuario=$usuario['id'];
                    $nombre = $usuario['nombre'];
                    $nacido = $usuario['nacido'];
                    $sexo = $usuario['sexo'];
                    $imagen = $usuario['foto'];
                    $deportes = leerdeportes($db, $usuario['id']);
                    echo '<input type="hidden" name="id" value="'.$id_usuario.'" required></p>';
                    echo '<p>Nombre: <input type="text" name="nombre" value="'.$nombre.'" required></p>';
                    echo '<p>Fecha de nacimiento <input type="date" name="fnacimiento" value="'.$nacido.'" required> </p>';
                    echo '<p>Sexo </p>';
                    echo '<ul>';
                    //echo "|".$sexo."|";
                        if($sexo=="H"){
                            echo '<li><p>Hombre <input type="radio" name="sexo" value="H" required checked </p></li>';
                            echo '<li> <p>Mujer <input type="radio" name="sexo" value="M" required </p></li>';
                        }
                        else{
                            echo '<li><p>Hombre <input type="radio" name="sexo" value="H" required </p></li>';
                            echo '<li> <p>Mujer <input type="radio" name="sexo" value="M" required checked </p></li>';
                        }
                    echo '</ul>';
            
            
                    echo "<p>¿Qué deportes haces?</p>";
                    echo '<ul>';
                        //Llamamos a la función listardeportes
                        listardeportes($db, $deportes);
                    echo '</ul>';
                    echo '<p>Introduce una foto de perfi <input type="file" name="fotoperfil" id="fotoperfil" value="'.$imagen.'"></p>';
                    echo '<input  class="boton"  type="submit" name="Modificar" value="Enviar">';
                }
            }
    }





    //Esta variable recorre todos los deportes, los que tenga el usuario, los checkea
    function listardeportes($db, $deportes){
        $datos=$db->leerDatos('Deporte');
        foreach ($datos as $fila) {
            $cont=0;
            foreach ($deportes as $deporte) {
                if ($deporte==$fila['nombre']) {
                    echo '<li><p>'.$fila['nombre'].'<input type="checkbox" name="deporte[]" value="'.$fila['nombre'].'" checked></p></li>';
                    $cont=1;
                }
            }
            if($cont==0){
                echo '<li><p>'.$fila['nombre'].'<input type="checkbox" name="deporte[]" value="'.$fila['nombre'].'" ></p></li>';
            }
        }
    }

    //Creamos un array de todos los deportes que hace el usuario
    function leerdeportes($db,  $id_usuario){
        $databaseUD=$db->leerDatos('UsuarioDeporte');
        $arraydeportes=array();
        foreach ($databaseUD as $fila) {
            if ($fila['id_usuario']==$id_usuario) {
                $id_deporte=$fila['id_deporte'];
                $databaseDeportes=$db->leerDatos('Deporte');
                foreach ($databaseDeportes as $deporte) {
                    if($deporte['id']==$id_deporte){
                        array_push($arraydeportes, $deporte['nombre']);
                        echo "<br>";
                    }
                    else{
                    }
                }
            }
        }
        return $arraydeportes;
    }

    //Escribimos todos los deportes que hace el usuario
    function escribirDatosDeporte($db, $deportes){
        $ids_usuarios=$db->ultimoID('Usuario');
        $id_usuario="";
        foreach ($ids_usuarios as $id_usuarios) {
            $id_usuario=$id_usuarios['id'];
        }
        $dbdeportes=$db->leerDatos('Deporte');
        foreach ($dbdeportes as $dbdeporte) {
            foreach ($deportes as $deporte) {
                if ($dbdeporte['nombre']==$deporte) {
                    echo "Asignamos a usuario".$id_usuario." el deporte ".$dbdeporte['id'];
                    $datos=[
                        'id_usuario' => $id_usuario,
                        'id_deporte' => $dbdeporte['id'],
                    ];
                    $db->escribirDatos('UsuarioDeporte', $datos);
                }
                else{
                    echo $dbdeporte['nombre']." no es igual a ".$deporte;
                }
            
        }
        }
        
    }

    //Guardamos la imagen
    function guardarImagen($directorio_destino, $nombre_fichero)
{
    $tmp_name = $_FILES[$nombre_fichero]['tmp_name'];
    //si hemos enviado un directorio que existe realmente y hemos subido el archivo    
    if (is_dir($directorio_destino) && is_uploaded_file($tmp_name))
    {
        $img_file = $_FILES[$nombre_fichero]['name'];
        $img_type = $_FILES[$nombre_fichero]['type'];
        echo 1;
        // Si se trata de una imagen   
        if (((strpos($img_type, "gif") || strpos($img_type, "jpeg") ||
 strpos($img_type, "jpg")) || strpos($img_type, "png")))
        {
            //¿Tenemos permisos para subir la imágen?
            echo 2;
            if (move_uploaded_file($tmp_name, $directorio_destino . '/' . $img_file))
            {
                return true;
            }
        }
    }
    //Si llegamos hasta aquí es que algo ha fallado
    return false;
}
<?php
    require_once('lib.php');
    //$db=new DAO(SERVICE, USER, PASS, HOST, DBNAME);
    //echo "Se ha creado el nuevo dao con los datos".SERVICE.USER.PASS.HOST,DBNAME;
    $db=new DAO(SERVICE, USER, PASS, HOST, DBNAME);
        //echo "Se ha creado el nuevo dao con los datos".SERVICE.USER.PASS.HOST,DBNAME;
        //echo "<br>";
        //echo "conectado correctamente";
        //echo "<br>";

	if($db->dbExist()){

        if(isset($_POST['nombre'])){
            //var_dump($_POST);
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
            header('location: ../php/principal.php');
        }
        else if(isset($_POST['id_usuario'])){
            mostrarFormulario($db);
        }
        else{
            echo "no se ha pasado ni el id ni más valores";
        }
    }
    else{
    	echo "La base de datos no existe";
        $db->crearBase();
        header('Location: ../Index.php');
    }



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
                        //include('../lib/listardeportesmod.php?variable=$deportes');
                        listardeportes($db, $deportes);
                    echo '</ul>';
                    echo '<p>Introduce una foto de perfi <input type="file" name="fotoperfil" id="fotoperfil"></p>';
                    echo '<input type="submit" name="Modificar" value="Enviar">';
                }
            }
    }






    function listardeportes($db, $deportes){
        $datos=$db->leerDatos('Deporte');
        //var_dump($datos);
        foreach ($datos as $fila) {
            //echo "<br>";
            $cont=0;
            foreach ($deportes as $deporte) {
                //echo $fila['nombre']." y ".$deporte;
                //echo "<br>";
                if ($deporte==$fila['nombre']) {
                    echo '<li><p>'.$fila['nombre'].'<input type="checkbox" name="deporte[]" value="'.$fila['nombre'].'" checked></p></li>';
                    $cont=1;
                }
                
                //else if($cont==0 && $imp==0){
                    //echo '<li><p>'.$fila['nombre'].'<input type="checkbox" name="deporte[]" value="'.$fila['nombre'].'" ></p></li>';
                    //$cont=1;
                //}

            }
            if($cont==0){
                echo '<li><p>'.$fila['nombre'].'<input type="checkbox" name="deporte[]" value="'.$fila['nombre'].'" ></p></li>';
            }
            //echo '<li><p>'.$fila['nombre'].'<input type="checkbox" name="deporte[]" value="'.$fila['nombre'].'"></p></li>';
            //echo "<br>";
        }
    }
    function leerdeportes($db,  $id_usuario){
        $databaseUD=$db->leerDatos('UsuarioDeporte');
        //$databaseDeportes=$db->leerDatos('Deporte');
        $arraydeportes=array();
        foreach ($databaseUD as $fila) {
            if ($fila['id_usuario']==$id_usuario) {
                //echo "El id del usuario es ".$id_usuario." y el id deporte es ".$fila['id_deporte'];
                //echo "<br>";
                $id_deporte=$fila['id_deporte'];
                //echo "Hemos asignado el id deporte ".$id_deporte;
                $databaseDeportes=$db->leerDatos('Deporte');
                foreach ($databaseDeportes as $deporte) {
                    if($deporte['id']==$id_deporte){
                        //echo "Anadimos al array de deportes el deporte".$deporte['nombre'];
                        //echo "<br>";
                        array_push($arraydeportes, $deporte['nombre']);
                        echo "<br>";
                    }
                    else{
                        //echo $id_deporte." no es igual a ".$deporte['id'];
                        //echo "<br>";
                    }
                }
            }
        }
        return $arraydeportes;
    }
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
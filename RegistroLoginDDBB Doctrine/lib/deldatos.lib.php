<?php
    require_once('lib.php');
	$db=new DAO(SERVICE, USER, PASS, HOST, DBNAME);
    //Si la base de datos existe, procedemos al borrado de los datos del usuario
    if($db->dbExist()){
        //Borramos los datos de la taba UsuarioDeporte
        $datosUD=$db->leerDatos('UsuarioDeporte');
        foreach ($datosUD as $filaUD) {
            if($filaUD['id_usuario']==$_POST['id_usuario']){
                echo "Eliminamos las filas de UD con id_usuario ".$filaUD['id_usuario'];
                $db->eliminarDatos('UsuarioDeporte', $filaUD['id_usuario']);
            }
            else{

            }
        }
        //Borramos los datos de la tabla Usuario
        $datosUsuario=$db->leerDatos('Usuario');
        foreach ($datosUsuario as $filaUsuario) {
            if($filaUsuario['id']==$_POST['id_usuario']){
                echo "Eliminamos las filas de usuario con id ".$filaUsuario['id'];
                $db->eliminarDatos('Usuario', $filaUsuario['id']);
            }
            else{
                echo $filaUsuario['id']." no es igual a ".$_POST['id_usuario'];
                echo "<br>";
            }
        }

        //Volvemos a la página principal tras eliminar los datos
        header('Location: ../php/principal.php');
    }
    //Si la base de datos no existe, se crea
    else{
    	echo "La base de datos no existe";
        $db->crearBase();
        header('Location: ../Index.php');
    }
<?php
    require_once('lib.php');
	$db=new DAO(SERVICE, USER, PASS, HOST, DBNAME);
        echo "Se ha creado el nuevo dao con los datos".SERVICE.USER.PASS.HOST,DBNAME;
        echo "<br>";
        echo "conectado correctamente";
        echo "<br>";
    if($db->dbExist()){

        $datosUD=$db->leerDatos('UsuarioDeporte');
        foreach ($datosUD as $filaUD) {
            if($filaUD['id_usuario']==$_POST['id_usuario']){
                echo "Eliminamos las filas de UD con id_usuario ".$filaUD['id_usuario'];
                $db->eliminarDatos('UsuarioDeporte', $filaUD['id_usuario']);
            }
            else{

            }
        }
        
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

        
        header('Location: ../php/principal.php');
    }
    else{
    	echo "La base de datos no existe";
        $db->crearBase();
        header('Location: ../Index.php');
    }
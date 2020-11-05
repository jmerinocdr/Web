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
        $user=$_POST["user"];
        $password=$_POST["contrasena"];
        if (checkUserPsw($db, $user, $password)) {
            session_start();
            // Guardar datos de sesión
            $_SESSION["usuario"] = $_POST["user"];
            $_SESSION["autorizado"] = "true";
            session_regenerate_id();
            echo "Accedido correctamente";
            header('Location: ../php/principal.php');
        }
        else{
            echo "Usuario no encontrado o la clave no coincide";
            header('Location: ../Index.php');
        }
    }
    else{
    	echo "La base de datos no existe";
        $db->crearBase();
        header('Location: ../Index.php');
    }

    function checkUserPsw($db, $user, $password){
        $encontrado=false;
        $datos=$db->leerDatos('Passwd');
        var_dump($datos);
        foreach ($datos as $fila) {
            if($fila["usuario"]==$user && $fila["clave"]=$password){
                $encontrado=true;
            }
            else{

            }
        }
        return $encontrado;
    }

<?php
    require_once('lib.php');
    $db=new DAO(SERVICE, USER, PASS, HOST, DBNAME);
    //Si la base de datos existe, hacemos el procedimiento para verificar el login
	if($db->dbExist()){
        $user=$_POST["user"];
        $password=$_POST["contrasena"];
        //Si todo está correcto, iniciamos la sesión
        if (checkUserPsw($db, $user, $password)) {
            session_start();
            // Guardar datos de sesión
            $_SESSION["usuario"] = $_POST["user"];
            $_SESSION["autorizado"] = "true";
            session_regenerate_id();
            echo "Accedido correctamente";
            header('Location: ../php/principal.php');
        }
        //Si no se confirma la información, volvemos al principio
        else{
            echo "Usuario no encontrado o la clave no coincide";
            header('Location: ../Index.php');
        }
    }
    //Si la base de datos, no existe, se crea
    else{
    	echo "La base de datos no existe";
        $db->crearBase();
        header('Location: ../Index.php');
    }

    //Esta función, confirma los datos de inicio de sesión
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

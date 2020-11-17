<?php
    require_once('lib.php');
    $db=new DAO(SERVICE, USER, PASS, HOST, DBNAME);
    //Si la base de datos existe, guardamos el usuario y clave
	if($db->dbExist()){
        $usuario=$_POST["usuario"];
        $clave=$_POST["clave"];
        $pclave=$_POST["pclave"];
        if(checkDbPsw($clave, $pclave) && checkUsr($db, $usuario)){
            $datos = [
                'usuario' => $usuario,
                'clave' => $clave,
            ];
            echo "<br>";
            echo "Imprimimos los datos para escribir ";
            echo "<br>";
            var_dump ($datos);
            echo "<br>";
            $db->escribirDatos('Passwd', $datos);
            header('Location: ../Index.php');
        }
        else{
            header('Location: ../Index.php');
        }
        
    }
    //Si la base no existe, se crea
    else{
    	echo "La base de datos no existe";
        $db->crearBase();
        header('Location: ../Index.php');
    }

    //Confirmamos que este usuario no existe
    function checkUsr($db, $usuario){
        $noEncontrado=true;
        $datos=$db->leerDatos('Passwd');
        var_dump($datos);
        foreach ($datos as $fila) {
            if($fila["usuario"]==$usuario){
                $noEncontrado=false;
            }
            else{
            }
        }
        return $noEncontrado;
    }

    //Confirmamos que las dos contrasenas son iguales
    function checkDbPsw($clave, $pclave){
        if ($clave==$pclave) {
            return true;
        }
        else{
            return false;
        }
    }
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
    else{
    	echo "La base de datos no existe";
        $db->crearBase();
        header('Location: ../Index.php');
    }
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

    function checkDbPsw($clave, $pclave){
        if ($clave==$pclave) {
            return true;
        }
        else{
            return false;
        }
    }
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
        $datos=$db->leerDatos('Deporte');
        var_dump($datos);
        foreach ($datos as $fila) {
            //echo "<br>";
            echo '<li><p>'.$fila['nombre'].'<input type="checkbox" name="deporte[]" value="'.$fila['nombre'].'"></p></li>';
            //echo "<br>";
        }
    }
    else{
    	echo "La base de datos no existe";
        $db->crearBase();
        header('Location: ../Index.php');
    }
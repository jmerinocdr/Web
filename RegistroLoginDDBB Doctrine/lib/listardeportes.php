<?php
 require_once('lib.php');
    $db=new DAO(SERVICE, USER, PASS, HOST, DBNAME);

    //Si la base de datos existe, recorremos los deportes mostrando un checkbox
    if($db->dbExist()){
        $datos=$db->leerDatos('Deporte');
        foreach ($datos as $fila) {
            echo '<li><p>'.$fila['nombre'].'<input type="checkbox" name="deporte[]" value="'.$fila['nombre'].'"></p></li>';
        }
    }
    //Si la base de datos no existe, la creamos
    else{
    	echo "La base de datos no existe";
        $db->crearBase();
        header('Location: ../Index.php');
    }
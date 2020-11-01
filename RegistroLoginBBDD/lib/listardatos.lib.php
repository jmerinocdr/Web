<?php
 require_once('lib.php');
    //$db=new DAO(SERVICE, USER, PASS, HOST, DBNAME);
    //echo "Se ha creado el nuevo dao con los datos".SERVICE.USER.PASS.HOST,DBNAME;
    $db=new DAO(SERVICE, USER, PASS, HOST, DBNAME);
        echo "Se ha creado el nuevo dao con los datos".SERVICE.USER.PASS.HOST,DBNAME;
        echo "<br>";
        echo "conectado correctamente";
        echo "<br>";
    if($db->dbExist()){
        $datos=$db->leerDatos('Usuario');
        var_dump($datos);
        foreach ($datos as $fila) {
            echo "<tr>";
            echo "<td>".$fila['id']."<td>";
            echo "<td>".$fila['nombre']."<td>";
            echo "<td>".$fila['nacido']."<td>";
            echo "<td>".$fila['sexo']."<td>";
            echo "<td>".listarDeportes($db, $fila["id"])."<td>";
            echo "<td>".$fila['foto']."<td>";
        }
    }
    else{
    	echo "La base de datos no existe";
        $db->crearBase();
        header('Location: ../Index.php');
    }

    function listarDeportes($db, $id_usuario){
    	$deportes;
    	$datos=$db->leerDatos('UsuarioDeporte');
        var_dump($datos);
        
        foreach ($datos as $fila) {
            if ($id_usuario==$fila['id_usuario']) {
            	$datos = ['id_deporte' => $fila['id_deporte']];
            	$sql="
            		SELECT nombre FROM deporte WHERE id=:id_deporte;
            	";
            	$db->ejecutar($sql, $datos);
            }
            else{

            }
        }
    }
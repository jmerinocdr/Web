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
        //var_dump($datos);
        foreach ($datos as $fila) {
            echo "<tr>";
                echo "<td><p>".$fila['id']."</p></td>";
                echo "<td><p>".$fila['nombre']."</p></td>";
                echo "<td><p>".$fila['nacido']."</p></td>";
                echo "<td><p>".$fila['sexo']."</p></td>";
                echo "<td><p>".listarDeportes($db, $fila["id"])."</p></td>";
                echo "<td><p>".$fila['foto']."</p></td>";
                include_once('../Formularios/formDelModDatos.php');
            echo "</tr>";
        }
    }
    else{
    	echo "La base de datos no existe";
        $db->crearBase();
        header('Location: ../Index.php');
    }

    function listarDeportes($db, $id_usuario){
    	$deportes='| ';
    	$datos=$db->leerDatos('UsuarioDeporte');
        //var_dump($datos);
        
        foreach ($datos as $fila) {
            if ($id_usuario==$fila['id_usuario']) {
            	$datosDeporte=$db->leerDatos('Deporte');
                foreach ($datosDeporte as $filaDeporte) {
                    if ($fila['id_deporte']==$filaDeporte['id']) {
                        $deportes = $deportes.$filaDeporte['nombre']." | ";
                    }
                    else{

                    }
                }
            }
            else{

            }
        }
        return $deportes;
    }
<?php
 require_once('lib.php');
    $db=new DAO(SERVICE, USER, PASS, HOST, DBNAME);
    //Si existe la base de datos, listamos los datos de cada usuario
    if($db->dbExist()){
        $datos=$db->leerDatos('Usuario');
        foreach ($datos as $fila) {
            echo "<tr>";
                $id=$fila['id'];
                echo "<td><p>".$fila['id']."</p></td>";
                echo "<td><p>".$fila['nombre']."</p></td>";
                echo "<td><p>".$fila['nacido']."</p></td>";
                echo "<td><p>".$fila['sexo']."</p></td>";
                echo "<td><p>".listarDeportes($db, $fila["id"])."</p></td>";
                echo "<td><p><img src =".DIRECTORIO.$fila['foto']." /></p></td>";
                include('../Formularios/formDelModDatos.php');
            echo "</tr>";
        }
    }
    else{
    	echo "La base de datos no existe";
        $db->crearBase();
        header('Location: ../Index.php');
    }

    //Listamos los deportes del usuario
    function listarDeportes($db, $id_usuario){
    	$deportes='| ';
    	$datos=$db->leerDatos('UsuarioDeporte');
        
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
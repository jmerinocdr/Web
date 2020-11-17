<?php
 require_once('lib.php');

        include_once('../Controllers/usuario.controller.php?accion=""');

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
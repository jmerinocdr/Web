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

        if(isset($_POST['nombre'])){
                //var_dump($_POST);
                $nombre = $_POST["nombre"];
                $fnacimiento = $_POST["fnacimiento"];
                $sexo = $_POST['sexo'];
                $imagen = $_FILES['fotoperfil']['name'];
                $datos=[
                    'nombre' => $nombre,
                    'nacido' => $fnacimiento,
                    'sexo' => $sexo,
                    'foto' => $imagen,
                ];
                $db->escribirDatos('Usuario', $datos);
                escribirDatosDeporte($db, $_POST['deporte']);
                header('location: ../php/principal.php');
            }
    }
    else{
    	echo "La base de datos no existe";
        $db->crearBase();
        header('Location: ../Index.php');
    }

    function escribirDatosDeporte($db, $deportes){
        $ids_usuarios=$db->ultimoID('Usuario');
        $id_usuario="";
        foreach ($ids_usuarios as $id_usuarios) {
            $id_usuario=$id_usuarios['id'];
        }
        $dbdeportes=$db->leerDatos('Deporte');
        foreach ($dbdeportes as $dbdeporte) {
            foreach ($deportes as $deporte) {
                if ($dbdeporte['nombre']==$deporte) {
                    echo "Asignamos a usuario".$id_usuario." el deporte ".$dbdeporte['id'];
                    $datos=[
                        'id_usuario' => $id_usuario,
                        'id_deporte' => $dbdeporte['id'],
                    ];
                    $db->escribirDatos('UsuarioDeporte', $datos);
                }
                else{
                    echo $dbdeporte['nombre']." no es igual a ".$deporte;
                }
            
        }
        }
        
    }
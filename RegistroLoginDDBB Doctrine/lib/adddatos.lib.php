<?php
    require_once('lib.php');
    
    //Creamos el dao para usar en la página de anadir datos
    $db=new DAO(SERVICE, USER, PASS, HOST, DBNAME);

    //Si la base de datos existe, continuamos
	if($db->dbExist()){
        //Si recibe algo por el post, lo anadimos a la base de datos
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
                guardarImagen(DIRECTORIO, 'fotoperfil');
                header('location: ../php/principal.php');
            }
    }
    //Si la base de datos no existe, la creamos y volvemos al inicio
    else{
    	echo "La base de datos no existe";
        $db->crearBase();
        header('Location: ../Index.php');
    }

    //Funcion que escribe los deportes dentro de la base de datos
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

    //Función que se dedica a guardar la imagen
    function guardarImagen($directorio_destino, $nombre_fichero)
{
    $tmp_name = $_FILES[$nombre_fichero]['tmp_name'];
    //si hemos enviado un directorio que existe realmente y hemos subido el archivo    
    if (is_dir($directorio_destino) && is_uploaded_file($tmp_name))
    {
        $img_file = $_FILES[$nombre_fichero]['name'];
        $img_type = $_FILES[$nombre_fichero]['type'];
        echo 1;
        // Si se trata de una imagen   
        if (((strpos($img_type, "gif") || strpos($img_type, "jpeg") ||
 strpos($img_type, "jpg")) || strpos($img_type, "png")))
        {
            //¿Tenemos permisos para subir la imágen?
            echo 2;
            if (move_uploaded_file($tmp_name, $directorio_destino . '/' . $img_file))
            {
                return true;
            }
        }
    }
    //Si llegamos hasta aquí es que algo ha fallado
    return false;
}
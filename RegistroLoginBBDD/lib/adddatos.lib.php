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

        if(isset($_POST['nombre'])){
                //var_dump($_POST);
                $nombre = $_POST["nombre"];
                $apellido = $_POST["apellido"];
                $fnacimiento = $_POST["fnacimiento"];
                $sexo = $_POST['sexo'];
                $deportes="";
                $cont=0;
                foreach ($_POST['deporte'] as $depo) {
                    if ($cont==0) {
                        $deportes = $depo;
                        //echo $cont . $depo;
                        $cont++;
                    }
                    else{
                        $deportes = $deportes . ',' . $depo;
                        //echo $cont . $depo;
                    }
                }
                echo $deportes;
                $imagen = $_FILES['fotoperfil']['name'];
                $datos=[
                    'nombre' => $nombre,
                    'nacido' => $fnacimiento
                    'sexo' => $sexo
                    'foto' => $imagen
                ]
                $db->escribirDatos('Usuario', $datos);
                escribir
                header('location: ../php/principal.php');
            }


        /*
        $nombre=$_POST["usuario"];
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
        */
    }
    else{
    	echo "La base de datos no existe";
        $db->crearBase();
        header('Location: ../Index.php');
    }
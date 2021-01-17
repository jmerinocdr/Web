<?php
    require_once('lib.php');
    $db=new DAO(SERVICE, USER, PASS, HOST, DBNAME);
    //Si la base de datos existe, hacemos el procedimiento para verificar el login
        $username=$_POST["username"];
        $passwd=$_POST["passwd"];
        //Si todo está correcto, iniciamos la sesión
        if (checkUserPsw($db, $username, $passwd)) {
            session_start();
            // Guardar datos de sesión
            $_SESSION["username"] = $_POST["username"];
            $_SESSION["autorized"] = "true";
            session_regenerate_id();
            echo "Access";
            header('Location: ../php/controller.php?action=gallery');
        }
        //Si no se confirma la información, volvemos al principio
        else{
            echo "User not found or pasword doesn't match";
            header('Location: ../php/login.php');
        }


    //Esta función, confirma los datos de inicio de sesión
    function checkUserPsw($db, $username, $passwd){
        $find=false;
        $data=$db->readData('user');
        var_dump($data);
        foreach ($data as $row) {
            if($row["username"]==$username && $row["passwd"]==$passwd){
                $find=true;
            }
            else{

            }
        }
        return $find;
    }

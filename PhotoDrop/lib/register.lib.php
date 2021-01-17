<?php
    require_once('lib.php');
        $db=new DAO(SERVICE, USER, PASS, HOST, DBNAME);
            $username=$_POST['username'];
            $passwd=$_POST['passwd'];
            $ppasswd=$_POST['ppasswd'];
            $name=$_POST['name'];
            $surname=$_POST['surname'];
            $sex=$_POST['sex'];
            $bday=$_POST['bday'];
            $uphoto=$_POST['uphoto'];

            if(checkDbPsw($passwd, $ppasswd) && checkUsr($db, $username)){
                $data = [
                    'username' => $username,
                    'passwd' => $passwd,
                    'name' => $name,
                    'surname' => $surname,
                    'sex' => $sex,
                    'bday' => $bday,
                    'uphoto' => $uphoto,
                ];
                $db->writeData('user', $data);
                header('Location: ../php/login.php');
            }
            else{
                header('Location: ../php/register.php');
            }
    

      //Confirmamos que este usuario no existe
      function checkUsr($db, $username){
        $notfound=true;
        $data=$db->readData('user');
        var_dump($data);
        foreach ($data as $row) {
            if($row["username"]==$username){
                $notfound=false;
            }
            else{
            }
        }
        return $notfound;
    }

    //Confirmamos que las dos contrasenas son iguales
    function checkDbPsw($passwd, $ppasswd){
        if ($passwd==$ppasswd) {
            return true;
        }
        else{
            return false;
        }
    }
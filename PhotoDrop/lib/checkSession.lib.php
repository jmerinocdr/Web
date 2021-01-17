<?php
function checkSession(){
    session_start();
    if($_SESSION["autorized"] != "true"){
        header('Location: ../php/login.php');
    }
    else if($_SESSION["autorized"] != "jaime2m1"){
        header('Location: ../php/errorInfo.php');
    }
}
function exitSession(){
    session_start();
    $_SESSION["autorized"] = "false";
}
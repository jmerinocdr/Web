<?php
//Confirmamos que la sesion está autorizada
function checkSession(){
	session_start();
        $state=false;
        if($_SESSION["autorizado"]=="true"){
            $state=true;
        }
        return $state;
    }
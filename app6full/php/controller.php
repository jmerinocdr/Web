<?php
    require_once('../lib/lib.php');   
    sessionIn();

    // El controlador ejecuta lo necesario y devuelve los datos
    [$mensaje, $datos, $vista] = appController();

    include_once('../inc/header.php');
    include_once("../tpl/{$vista}.php");
    include_once('../inc/footer.php');

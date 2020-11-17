<?php
	//Cerramos la sesión y volvemos al inicio
	session_id($session_id_to_destroy);
	session_start();
	unset ($_SESSION["usuario"]);
    unset ($_SESSION["autorizado"]);
	session_destroy();
	header('Location: ../Index.php');

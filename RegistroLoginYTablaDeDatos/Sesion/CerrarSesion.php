<?php
 	session_start();
 	$_SESSION["autorizado"] = false;
 	unset($_SESSION["autorizado"]);
 	session_destroy();
 	header('location: ../Index.html');
?>
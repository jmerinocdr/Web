<?php
	require_once('../lib/lib.php');
	$act = $_GET['act'];
	if (checkSession()==true) {
		include_once('../HeaderFooter/Header.php');
		include_once("../Formularios/{$act}.php");
		include_once('../MenusHref/menuAddExit.php');
		include_once('../HeaderFooter/Footer.php');
	}
	else{
		header('Location: ../Index.php');
	}
	
<?php
	require_once('../lib/lib.php');
	if (checkSession()==true) {
		include_once('../HeaderFooter/Header.php');
		include_once('../Formularios/tablaDatos.php');
		include_once('../MenusHref/menuAddExit.php');
		include_once('../HeaderFooter/Footer.php');
	}
	else{
		header('Location: ../Index.php');
	}
	
<table border="1">
	<tr>
		<td><p>Id</p></td>
		<td><p>Nombre</p> </td>
		<td><p>Nacimiento</p></td>
		<td><p>Sexo</p></td>
		<td><p>Deporte</p></td>
		<td><p>Foto</p></td>
	</tr>
	<?php
	$_POST['accion']='mostrarTodos';
	$_POST['datos']="";
	include_once('../Controllers/usuario.controller.php');
echo "</table>";
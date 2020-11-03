<td>
	<form action="../lib/deldatos.lib.php" method="post">
		<input type="hidden" name="id_usuario" value="<?php echo $id; ?>">
		<input type="submit" name="Eliminar" value="Eliminar"></input>
	</form>
	<form action="../lib/moddatos.lib.php" method="post">
		<input type="hidden" name="id_usuario" value="<?php echo $id; ?>">
		<input type="submit" name="Modificar" value="Modificar">
	</form>
</td>
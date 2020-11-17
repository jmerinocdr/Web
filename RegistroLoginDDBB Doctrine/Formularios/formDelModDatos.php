<td>
	<form action="../lib/deldatos.lib.php" method="post">
		<input type="hidden" name="id_usuario" value="<?php echo $id; ?>">
		<input  class="boton" type="submit" name="Eliminar" value="Eliminar"></input>
	</form>
	<form action="../Formularios/formMod.php" method="post">
		<input type="hidden" name="id_usuario" value="<?php echo $id; ?>">
		<input class="boton"  type="submit" name="Modificar" value="Modificar">
	</form>
</td>
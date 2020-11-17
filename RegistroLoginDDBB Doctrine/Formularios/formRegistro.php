<div>
	<div class="formulario">
		<form action="../Controllers/passwd.controller.php" method="post">
			<input type="hidden" name="array" value="true">
			<input type="hidden" name="accion" value="registerPsw">
			<p>Nombre <input type="text" name="usuario" required=""></p>
			<p>Contraseña <input type="password" name="contrasena" required=""></p>
			<p>Verificar Contraseña <input type="password" name="contrasenap" required=""></p>
			<input  class="boton"  type="submit" name="Enviar">
		</form>
	</div>
</div>
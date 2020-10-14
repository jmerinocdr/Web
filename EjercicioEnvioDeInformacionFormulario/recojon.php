<!DOCTYPE html>
<html>
	<body>
		<form action="recojonfin.php" method="POST">
			<p>Nombre: <?php print($_POST[Nombre])?> </p>
			<p>Apellido: <?php print($_POST[Apellido])?></p>
			<p>Contrasena: <?php print($_POST[Contrasena])?></p>
			<p>Fecha de nacimiento: <?php print($_POST[Fnacimiento])?></p>
			<p>Edad: 
			<?php 
			$fecha=time()-strtotime($_POST[Fnacimiento]);
			$edad=floor($fecha/31536000);
			print($edad);
			?>
			</p>
			<p>Sexo: <?php print($_POST[Sexo])?></p>
			<p>Intereses: <?php print($_POST[Intereses])?></p>
			


			<input type="hidden" name="Nombre" value=<?php print($_POST[Nombre])?>>
			<input type="hidden" name="Apellido" value=<?php print($_POST[Apellido])?>>
			<input type="hidden" name="Contrasena" value=<?php print($_POST[Contrasena])?>>
			<input type="hidden" name="Fnacimiento" value=<?php print($_POST[Fnacimiento])?>>
			<input type="hidden" name="Sexo" value=<?php print($_POST[Sexo])?>>
			<input type="hidden" name="Intereses" value=<?php print($_POST[Intereses])?>>



			<input type="submit" name="submit" value="Confirmar"></p>
		</form>
	</body>
</html>
<!--
<?php
	/*
		print
		print "<pre>";
		print_r ($_POST);
		print "</pre>";
	*/
	?>
-->
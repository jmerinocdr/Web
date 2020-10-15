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
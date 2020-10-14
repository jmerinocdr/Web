<!DOCTYPE html>
<html>
	<body>
		<h1>Formulario</h1>
		<form action="recojon1.php" method="post" enctype="multipart/form-data">
            <p>Nombre: <input type="text" name="nombre"></p>
            <p>Apellido: <input type="text" name="apellido"></p>
			<p>Fecha de nacimiento <input type="date" name="fnacimiento"></p>
			<p>¿Qué deportes haces?</p>
			<ul>
                <li><p>Natación<input type="checkbox" name="n"$></p></li>
                <li><p>Baloncesto<input type="checkbox" name="b"$></p></li>
                <li><p>Futbol<input type="checkbox" name="f"$></p></li>
                <li><p>Ciclismo<input type="checkbox" name="c"$></p></li>
            </ul>
			<p>Introduce una foto de perfi <input type="file" name="fotoperfil" id="fotoperfil"></p>
			<p><input type="submit" value="enviar"></p>
		</form>
	</body>
</html>
<!DOCTYPE html>
<html>
	<body>
		<h1>No hay ningún archivo con información</h1>
		<h1>Completa los datos</h1>
		<form action="MainPage.php" method="post" enctype="multipart/form-data">
            <p>Nombre: <input type="text" name="nombre" required></p>
            <p>Apellido: <input type="text" name="apellido" required></p>
			<p>Fecha de nacimiento <input type="date" name="fnacimiento" required> </p>
			<p>¿Qué deportes haces?</p>
			<ul>
                <li><p>Natación<input type="checkbox" name="deporte[]" value="n"></p></li>
                <li><p>Baloncesto<input type="checkbox" name="deporte[]" value="b"></p></li>
                <li><p>Futbol<input type="checkbox" name="deporte[]" value="f"></p></li>
                <li><p>Ciclismo<input type="checkbox" name="deporte[]" value="c"></p></li>
            </ul>
			<p>Introduce una foto de perfi <input type="file" name="fotoperfil" id="fotoperfil"></p>
			<p><input type="submit" value="enviar"></p>
		</form>
	</body>
</html>
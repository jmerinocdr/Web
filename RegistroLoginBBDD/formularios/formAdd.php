<?php include_once('../HeaderFooter/Header.php'); ?>
    <h1>Introduce los datos para la nueva persona</h1>
    <div class="formulario">
    <form action="../lib/adddatos.lib.php" method="post" enctype="multipart/form-data">
        <p>Nombre: <input type="text" name="nombre" required></p>
        <p>Fecha de nacimiento <input type="date" name="fnacimiento" required> </p>
        <p>Sexo </p>
        <ul>
            <li><p>Hombre <input type="radio" name="sexo" value="H" required></p></li>
            <li> <p>Mujer <input type="radio" name="sexo" value="M" required></p></li>
        </ul>
            
            
        <p>¿Qué deportes haces?</p>
        <ul>
            <?php include_once('../lib/listardeportes.php'); ?>
        </ul>
        <p>Introduce una foto de perfi <input type="file" name="fotoperfil" id="fotoperfil"></p>
        <p><input type="submit" value="enviar"></p>
    </form>
    </div>
</body>
</html>

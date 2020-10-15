<?php
    // Destruyo la sesión
    session_start();
    setcookie(session_name(), '', time() - 86400, '/');
    session_destroy();
    // Destruyo la cookie
    setcookie('idioma', '', time() - 86400);
    // Control de errores
    $errores = [
        'login' => 'Acceso no autorizado'
    ];
    $error = isset($_GET['error']) && isset($errores[$_GET['error']]) ? $errores[$_GET['error']] : '';
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>PHP GET+POST+COOKIE+SESSION</title>
        <meta charset="utf-8">
        <style>
            .error {
                color: red;
            }
        </style>
    </head>
    <body>
        <?php
            if ($error) {
                echo "<h3 class=\"error\">$error</h3>";
            }
        ?>
        <h1>Identificación</h1>
        <form action="dentro.php" method="post">
            <label>Usuario: <input type="text" name="usuario" required></label><br>
            <label>Clave: <input type="password" name="clave" required></label><br>
            <label>Idioma:
                <input type="radio" name="idioma" value="es" required>español
                <input type="radio" name="idioma" value="en">inglés
                <input type="radio" name="idioma" value="fr">francés
            </label><br>
            <input type="submit" value="entrar">
        </form>
    </body>
</html>
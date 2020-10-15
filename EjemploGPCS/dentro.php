<?php
    session_start();
    if (isset($_SESSION['usuario'])) { // Sesión abierta
        $usuario = $_SESSION['usuario'];
        $idioma = $_COOKIE['idioma'];
    } else { // Viene del formulario de entrada
        $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : '';
        $clave = isset($_POST['clave']) ? $_POST['clave'] : '';
        $idioma = isset($_POST['idioma']) ? $_POST['idioma'] : 'es';

        if ($usuario === 'abrete' && $clave === 'sesamo') { // Autorizado
            $_SESSION['usuario'] = $usuario;
            setcookie('idioma', $idioma, time() + 80456);
        } else { // No autorizado
            header('location: login.php?error=login');
        }
    }
    $holas = [
        'es' => 'Hola',
        'en' => 'Hello',
        'fr' => 'Salut'
    ];
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>PHP GET+POST+COOKIE+SESSION</title>
        <meta charset="utf-8">
    </head>
    <body>
        <h1>Dentro</h1>
        <h2><?= $holas[$idioma] ?> <?= $usuario ?></h2>
        <form action="salir.php" method="post">
            <input type="submit" value="continuar">
        </form>
    </body>
</html>
<?php
    session_start();
    if (isset($_SESSION['usuario'])) { // Sesión abierta
        $usuario = $_SESSION['usuario'];
    } else { // No autorizado
        header('location: login.php?error=login');
    }
    $idioma = $_COOKIE['idioma'];
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
        <h1>Saliendo</h1>
        <h2><?= $holas[$idioma] ?> <?= $usuario ?></h2>
        <form action="dentro.php" method="post">
            <input type="submit" value="volver">
        </form>
        <form action="login.php" method="post">
            <input type="submit" value="salir">
        </form>
    </body>
</html>
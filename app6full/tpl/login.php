<div class="warning"><?= appError() ?></div>

<h1>Identificación</h1>
<form action="controller.php" method="post">
    <input type="hidden" name="vista" value="list">
    <label>Usuario: <input type="text" name="usuario" required></label>
    <label>Clave: <input type="password" name="clave" required></label>
    <input type="submit" value="entrar">
</form>

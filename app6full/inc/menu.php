<?php if (isset($_SESSION['usuario'])) { ?>
Usuario: <?= $_SESSION['usuario'] ?>
<form method="post">
    <input type="hidden" name="accion" value="salir">
    <input type="submit" value="salir">
</form>
<form method="post">
    <input type="hidden" name="vista" value="list">
    <input type="submit" value="Usuarios">
</form>
<form method="post">
    <input type="hidden" name="vista" value="deporte.list">
    <input type="submit" value="Deportes">
</form>
<?php } ?>
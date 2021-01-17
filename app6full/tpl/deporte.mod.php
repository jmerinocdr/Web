<h1>Modificar un deporte</h1>
<form method="post">
    <input type="hidden" name="vista" value="deporte.list">
    <input type="hidden" name="accion" value="modificar">
    <input type="hidden" name="registro" value="<?= $datos->getId() ?>">

    <label>Nombre: <input type="text" name="nombre" size="30" value="<?= $datos->getNombre() ?>" required></label>
    <br>
    <input type="submit" value="modificar">
</form>
<form method="post">
    <input type="hidden" name="vista" value="deporte.list">
    <input type="hidden" name="accion" value="eliminar">
    <input type="hidden" name="registro" value="<?= $_POST['registro'] ?>">
    <input type="submit" value="eliminar">
</form>
<form method="post">
    <input type="hidden" name="vista" value="deporte.list">
    <input type="submit" value="volver">
</form>

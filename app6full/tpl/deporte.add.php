<h1>Añadir un deporte</h1>
<form method="post">
    <input type="hidden" name="vista" value="deporte.list">
    <input type="hidden" name="accion" value="añadir">

    <label>Nombre: <input type="text" name="nombre" size="30" required></label>
    <br>
    <input type="submit" value="guardar">
</form>
<form method="post">
    <input type="hidden" name="vista" value="deporte.list">
    <input type="submit" value="volver">
</form>

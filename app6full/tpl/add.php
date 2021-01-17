<h1>Añadir</h1>
<form method="post" enctype="multipart/form-data">
    <input type="hidden" name="vista" value="list">
    <input type="hidden" name="accion" value="añadir">

    <label>Nombre: <input type="text" name="nombre" size="30" required></label>
    <label>Nacido: <input type="date" name="nacido" required></label>
    <label>Sexo: <?= inputRadio('sexo', Usuario::LST_SEXOS, '', 'required') ?></label>
    <label>Deportes: <?= inputCheckbox('deporte[]', $datos->listaDeportes) ?></label>
    <label>Foto: <input type="file" name="foto"></label>
    <br>
    <input type="submit" value="guardar">
</form>
<form method="post">
    <input type="hidden" name="vista" value="list">
    <input type="submit" value="volver">
</form>

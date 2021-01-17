<h1>Modificar</h1>
<form method="post" enctype="multipart/form-data">
    <input type="hidden" name="vista" value="list">
    <input type="hidden" name="accion" value="modificar">
    <input type="hidden" name="registro" value="<?= $datos->getId() ?>">

    <label>Nombre: <input type="text" name="nombre" size="30" value="<?= $datos->getNombre() ?>" required></label>
    <label>Nacido: <input type="date" name="nacido" value="<?= $datos->getNacido() ?>" required></label>
    <label>Sexo: <?= inputRadio('sexo', Usuario::LST_SEXOS, $datos->getSexo(), 'required') ?></label>
    <label>Deportes: <?= inputCheckbox('deporte[]', $datos->listaDeportes, $datos->getDeportes()) ?></label>
    <label>Foto:
        <?php
            if ($datos->getFoto()) {
                printf('<img src="%s/%s">', DIR_FOTOS, $datos->getFoto());
                printf('<input type="hidden" name="foto" value="%s">', $datos->getFoto());
            }
        ?>
        <input type="file" name="foto">
    </label>
    <br>
    <input type="submit" value="modificar">
</form>
<form method="post">
    <input type="hidden" name="vista" value="list">
    <input type="hidden" name="accion" value="eliminar">
    <input type="hidden" name="registro" value="<?= $_POST['registro'] ?>">
    <input type="submit" value="eliminar">
</form>
<form method="post">
    <input type="hidden" name="vista" value="list">
    <input type="submit" value="volver">
</form>

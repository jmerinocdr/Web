<div class="warning"><?= $mensaje ?></div>
<h1>Deportes</h1>
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Nombre</th>
        </tr>
    </thead>
    <?php
        // Muestro los datos de los deportes
        foreach ($datos as $indice => $deporte) {
            $numero = $indice + 1;
            $seleccion =<<< EOT
                <form method="post">
                    <input type="hidden" name="vista" value="deporte.mod">
                    <input type="hidden" name="accion" value="leer">
                    <input type="hidden" name="registro" value="{$deporte->getId()}">
                    <input type="submit" value="$numero">
                </form>
EOT;
            printf('<tr><td>%s</td><td>%s</td></tr>',
                $seleccion,
                $deporte->getNombre()
            );
        }
    ?>
</table>
<br>
<form method="post">
    <input type="hidden" name="vista" value="deporte.add">
    <input type="submit" value="añadir">
</form>

<div class="warning"><?= $mensaje ?></div>
<h1>Listado</h1>
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Nacido</th>
            <th>Sexo</th>
            <th>Deportes</th>
            <th>Foto</th>
        </tr>
    </thead>
    <?php
        $fila =<<< EOT
            <tr>
                <td>
                    <form method="post">
                        <input type="hidden" name="vista" value="mod">
                        <input type="hidden" name="accion" value="leer">
                        <input type="hidden" name="registro" value="%s">
                        <input type="submit" value="%s">
                    </form>
                </td>
                <td>%s</td>
                <td>%s</td>
                <td>%s</td>
                <td>%s</td>
                <td>%s</td>
            </tr>
EOT;
        // Muestro los datos de los usuarios
        if(!empty($_POST['caracteres'])){
            foreach ($datos as $indice => $usuario) {
                if(strpos($usuario->getNombre(), $_POST['caracteres']) !== false){
                    printf($fila,
                        $usuario->getId(),
                        $indice + 1,
                        $usuario->getNombre(),
                        formatDate($usuario->getNacido()),
                        $usuario->getDenominacionSexo(),
                        showOptions($usuario->getDeportes()),
                        $usuario->getFoto() ? '<img src="'.DIR_FOTOS.'/'.$usuario->getFoto().'">' : ''
                    );
                }
            }
        }
        else{
            foreach ($datos as $indice => $usuario) {
                printf($fila,
                    $usuario->getId(),
                    $indice + 1,
                    $usuario->getNombre(),
                    formatDate($usuario->getNacido()),
                    $usuario->getDenominacionSexo(),
                    showOptions($usuario->getDeportes()),
                    $usuario->getFoto() ? '<img src="'.DIR_FOTOS.'/'.$usuario->getFoto().'">' : ''
                );
            }
        }
    ?>
</table>
<p>
    <form method="post">
        <input type="hidden" name="vista" value="list">
        <input type="text" name="caracteres" value="<?php if(!empty($_POST['caracteres'])){echo $_POST['caracteres'];} else{ echo "";} ?>"> <input type="submit" value="Buscar">
    </form>

    <form action="../lib/exportar.dao.php" method="post">
        <input type="hidden" name="exportar" value="true">
        <input type="submit" value="Exportar">
    </form>
</p>
<br>
<form method="post">
    <input type="hidden" name="vista" value="add">
    <input type="submit" value="añadir">
</form>

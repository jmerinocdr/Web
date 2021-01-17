<?php
/**
 * Controlador de la aplicación
 * 
 * Dada una acción llama al método que la ejecuta
 * 
 * @return string mensaje
 */
function appController() {
    $vista = $_POST['vista'] ?? 'list';

    list($entidad) = explode('.', $vista);
    switch ($entidad) {
        case 'deporte':
            return appControllerDeporte();
        default:
            return appControllerUsuario();
    }
}

/**
 * Controlador de la aplicación de usuario
 * 
 * Dada una acción llama al método que la ejecuta
 * 
 * @return string mensaje
 */
function appControllerUsuario() {
    $mensaje = '';
    $datos = [];

    $dao = new UsuarioDao(FIC_DATOS, DIR_FOTOS);

    $accion = $_POST['accion'] ?? '';
    switch ($accion) {
        case 'añadir':
            $datos = $_POST;
            $datos['foto'] = $_FILES['foto'];
            $dao->add($datos);
            $mensaje = 'Usuario añadido';

            $datos = $dao->readAll();
        break;
        case 'modificar':
            $datos = $_POST;
            if ($_FILES['foto']['name']) {
                $datos['foto'] = $_FILES['foto'];
            }
            $dao->mod($datos);
            $mensaje = 'Usuario modificado';

            $datos = $dao->readAll();
        break;
        case 'eliminar':
            if ($dao->del($_POST['registro'])) {
                $mensaje = 'Usuario eliminado';
            } else {
                $mensaje = 'Usuario NO eliminado';
            }

            $datos = $dao->readAll();            
        break;
        case 'leer':
            $datos = $dao->read($_POST['registro']);
            $vista = 'mod';
        break;
        case 'salir':
            header('location: login.php');
        break;
        default:
            $datos = $dao->readAll();
    }

    $vista = $_POST['vista'] ?? '';
    switch ($vista) {
        case 'add':
            $datos = new stdClass();
            $daoDeporte = new DeporteDao(FIC_DATOS);
            $datos->listaDeportes = $daoDeporte->readAll();
        break;
        case 'mod':
            $daoDeporte = new DeporteDao(FIC_DATOS);
            $datos->listaDeportes = $daoDeporte->readAll();
        break;
        default:
        break;
    }

    return [$mensaje, $datos, $vista];
}

/**
 * Controlador de la aplicación de deporte
 * 
 * Dada una acción llama al método que la ejecuta
 * 
 * @return string mensaje
 */
function appControllerDeporte() {
    $mensaje = '';
    $datos = [];

    list($entidad, $vista) = explode('.', $_POST['vista']);

    $dao = new DeporteDao(FIC_DATOS);

    $accion = $_POST['accion'] ?? 'list';
    switch ($accion) {
        case 'añadir':
            $datos = $_POST;
            $dao->add($datos);
            $mensaje = 'Deporte añadido';

            $datos = $dao->readAll();
        break;
        case 'modificar':
            $datos = $_POST;
            $dao->mod($datos);
            $mensaje = 'Deporte modificado';

            $datos = $dao->readAll();
        break;
        case 'eliminar':
            if ($dao->del($_POST['registro'])) {
                $mensaje = 'Usuario eliminado';
            } else {
                $mensaje = 'Usuario NO eliminado';
            }
            $datos = $dao->readAll();
        break;
        case 'leer':
            $datos = $dao->read($_POST['registro']);
        break;
        default:
            $datos = $dao->readAll();
    }

    return [$mensaje, $datos, "deporte.$vista"];
}

/**
 * Devuelve un mensaje de error según la lista de errores
 */
function appError() {
    return isset($_GET['error']) && isset(LST_ERRORES[$_GET['error']]) ? LST_ERRORES[$_GET['error']] : '';
}

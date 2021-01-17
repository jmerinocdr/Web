<?php
/**
 * Clase DAO de Usuario
 */

require_once('dao.lib.php');
require_once('usuario.class.php');
require_once('deporte.class.php');

class UsuarioDao {
    private $pdo;
    private $fotos;

    /**
     * Constructor
     * 
     * @param string ruta del fichero de datos
     * @param string directorio de almacenamiento de fotos
     */
    function __construct($fichero, $fotos) {
        $this->fotos = $fotos;

        $dao = new Dao($fichero);
        $this->pdo = $dao->getPdo();
    }

    /**
     * Añade un usuario
     * 
     * @return bool éxito
     */
    function add($datos) {
        [$datos, $deportes] = $this->prepare($datos);

        $sql = 'INSERT INTO usuarios (nombre, nacido, sexo, foto) 
                VALUES (:nombre, :nacido, :sexo, :foto)';
        $stmt = $this->pdo->prepare($sql);
        if (!$stmt->execute($datos)) {
            return false;   // error
        }

        $id_usuario = $this->pdo->lastInsertId();
        $this->updDeportes($id_usuario, $deportes);

        return true;
    }

    /**
     * Modifica los datos de un usuario
     * 
     * @param array datos del usuario
     * @return bool éxito
     */
    function mod($datos) {
        [$datos, $deportes] = $this->prepare($datos);

        $sql = 'UPDATE usuarios 
                SET nombre = :nombre,
                    nacido = :nacido,
                    sexo = :sexo,
                    foto = :foto
                WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        if (!$stmt->execute($datos)) {
            return false;   // error
        }

        $id_usuario = $datos['id'];
        $this->updDeportes($id_usuario, $deportes);

        return true;
    }

    /**
     * Método auxiliar que actualiza los deportes de un usuario
     */
    private function updDeportes($id_usuario, $deportes) {
        $sql = 'DELETE FROM usuarios_deportes
                WHERE id_usuario = :id_usuario';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id_usuario' => $id_usuario]);

        $sql = 'INSERT INTO usuarios_deportes (id_usuario, id_deporte) 
                    VALUES (:id_usuario, :id_deporte)';
        $stmt = $this->pdo->prepare($sql);
        foreach ($deportes as $id_deporte) {
            $stmt->execute([
                'id_usuario' => $id_usuario,
                'id_deporte' => $id_deporte
            ]);
        }
    }

    /**
     * Método auxiliar que prepara los datos de un usuario
     * para ser tratados
     * 
     * @param array datos del usuario
     * @return array datos del usuario
     */
    private function prepare($datos) {
        if (isset($datos['registro'])) {
            $a['id'] = $datos['registro'];
        }
        $a['nombre'] = $datos['nombre'];
        $a['nacido'] = $datos['nacido'];
        $a['sexo'] = $datos['sexo'];
        if (isset($datos['foto']['name'])) {
            if ($datos['foto']['name']) {
                move_uploaded_file($datos['foto']['tmp_name'], $this->fotos.'/'.$datos['foto']['name']);
                $a['foto'] = $datos['foto']['name'];
            } else {
                $a['foto'] = '';
            }
        } else {
            $a['foto'] = $datos['foto'] ?? '';
        }

        $deportes = isset($datos['deporte']) ? $datos['deporte'] : [];

        return [$a, $deportes];
    }

    /**
     * Elimina un usuario
     * 
     * @param int id del usuario
     * @return bool éxito
     */
    function del($id) {
        $sql = 'DELETE FROM usuarios_deportes WHERE id_usuario = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);

        $sql = 'DELETE FROM usuarios WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
    
    /**
     * Lee todos los usuarios
     * 
     * @return array objetos de todos los usuarios
     */
    function readAll() {
        $todo = [];

        $sql = 'SELECT id_deporte
                FROM usuarios_deportes
                WHERE id_usuario = :id';
        $stmtDeporte = $this->pdo->prepare($sql);
        
        $sql = 'SELECT id, nombre, nacido, sexo, foto
                FROM usuarios
                ORDER BY nombre';
        $stmt = $this->pdo->query($sql);
        while ($datos = $stmt->fetch()) {
            $stmtDeporte->execute(['id' => $datos['id']]);
            $datos['deporte'] = $stmtDeporte->fetchAll();
            $todo[] = $this->convertRecord($datos);
        }
        return $todo;
    }

    /**
     * Devuelve un usuario dado su id
     * 
     * @param int id
     * @return object usuario
     */
    function read($id) {
        $sql = 'SELECT id, nombre, nacido, sexo, foto
                FROM usuarios
                WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        $datos = $stmt->fetch();

        // Leo los ids de los deportes de un usuario
        $sql = 'SELECT id_deporte
                FROM usuarios_deportes
                WHERE id_usuario = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        $datos['deporte'] = $stmt->fetchAll();

        return $this->convertRecord($datos);
    }

    /**
     * Método auxiliar convierte un array en un objeto Usuario
     * 
     * @param array datos del usuario
     * @return object usuario
     */
    private function convertRecord($datos) {
        $daoDeporte = new DeporteDao(FIC_DATOS);
        foreach ($datos['deporte'] as $indice => $deporte) {
            $datos['deporte'][$indice] = $daoDeporte->read($deporte['id_deporte']);
        }

        $registro = new Usuario(
            $datos['id'],
            $datos['nombre'],
            $datos['nacido'],
            $datos['sexo'],
            $datos['deporte'],
            $datos['foto']
        );

        return $registro;
    }
}

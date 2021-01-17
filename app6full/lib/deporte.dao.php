<?php
/**
 * Clase DAO de Deporte
 */

require_once('dao.lib.php');
require_once('deporte.class.php');

class DeporteDao {
    private $pdo;

    /**
     * Constructor
     * 
     * @param string ruta del fichero de datos
     */
    function __construct($fichero) {
        $dao = new Dao($fichero);
        $this->pdo = $dao->getPdo();
    }

    /**
     * Añade un deporte
     * 
     * @return bool éxito
     */
    function add($datos) {
        $datos = $this->prepare($datos);

        $sql = 'INSERT INTO deportes (nombre) 
                    VALUES (:nombre)';
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($datos);
    }

    /**
     * Modifica los datos de un deporte
     * 
     * @param array datos del deporte
     * @return bool éxito
     */
    function mod($datos) {
        $datos = $this->prepare($datos);

        $sql = 'UPDATE deportes 
                SET nombre = :nombre
                WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($datos);
    }

    /**
     * Método auxiliar que prepara los datos de un deporte
     * para ser tratados
     * 
     * @param array datos del deporte
     * @return array datos del deporte
     */
    private function prepare($datos) {
        if (isset($datos['registro'])) {
            $a['id'] = $datos['registro'];
        }
        $a['nombre'] = $datos['nombre'];
        return $a;
    }

    /**
     * Elimina un deporte
     * 
     * @param int id del deporte
     * @return bool éxito
     */
    function del($id) {
        $sql = 'DELETE FROM usuarios_deportes WHERE id_deporte = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);

        $sql = 'DELETE FROM deportes WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
    
    /**
     * Lee todos los deportes
     * 
     * @return array objetos todos los deportes
     */
    function readAll() {
        $todo = [];
        $sql = 'SELECT id, nombre
                FROM deportes
                ORDER BY nombre';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        while ($datos = $stmt->fetch()) {
            $todo[] = $this->convertRecord($datos);
        }
        return $todo;
    }

    /**
     * Devuelve un deporte dado su id
     * 
     * @param int id
     * @return object deporte
     */
    function read($id) {
        $sql = 'SELECT id, nombre
                FROM deportes
                WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        $datos = $stmt->fetch();
        return $this->convertRecord($datos);
    }

    /**
     * Método auxiliar convierte un array en un objeto Deporte
     * 
     * @param array datos del deporte
     * @return object deporte
     */
    private function convertRecord($datos) {
        $registro = new Deporte(
            $datos['id'],
            $datos['nombre']
        );
    
        return $registro;
    }
}
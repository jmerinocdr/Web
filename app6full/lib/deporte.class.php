<?php
/**
 * Clase Deportes
 */
class Deporte {
    private $id;
    private $nombre;

    /**
     * Constructor
     * 
     * @param string nombre
     */
    function __construct($id, $nombre) {
        $this->setId($id);
        $this->setNombre($nombre);
    }

    /**
     * Getters
     */
    function getId() { return $this->id; }
    function getNombre() { return $this->nombre; }

    /**
     * Setters
     */
    function setId($valor) { $this->id = $valor; }
    function setNombre($valor) { $this->nombre = trim($valor); }

    /**
     * Muestra una cadena representativa del usuario
     */
    function __toString() {
        return sprintf('[%s:%s]',
            $this->id,
            $this->nombre
        );
    }
}
<?php
/**
 * Clase Usuario
 */
class Usuario {
    const LST_SEXOS = [
        'M' => 'Mujer',
        'H' => 'Hombre'
    ];

    private $id;
    private $nombre;
    private $nacido;
    private $sexo;
    private $deportes;
    private $foto;

    /**
     * Constructor
     * 
     * @param string nombre
     * @param string nacido
     * @param string sexo
     * @param array deportes
     * @param string foto
     */
    function __construct($id, $nombre, $nacido = '1970-01-01', $sexo = 'M', $deportes = [], $foto = '') {
        $this->setId($id);
        $this->setNombre($nombre);
        $this->setNacido($nacido);
        $this->setSexo($sexo);
        $this->setDeportes($deportes);
        $this->setFoto($foto);
    }

    /**
     * Getters
     */
    function getId() { return $this->id; }
    function getNombre() { return $this->nombre; }
    function getNacido() { return $this->nacido; }
    function getSexo() { return $this->sexo; }
    function getDeportes() { return $this->deportes; }
    function getFoto() { return $this->foto; }

    /**
     * Setters
     */
    function setId($valor) { $this->id = $valor; }
    function setNombre($valor) { $this->nombre = trim($valor); }
    function setNacido($valor) { $this->nacido = trim($valor); }
    function setSexo($valor) { 
        $this->sexo = isset(Usuario::LST_SEXOS[$valor]) ? $valor : 'M';
    }
    function setDeportes($valores) { $this->deportes = $valores; }
    function setFoto($valor) { $this->foto = trim($valor); }

    /**
     * Devuelve la denominación completa del sexo
     * 
     * @return string denominación completa del sexo
     */
    function getDenominacionSexo() { 
        return Usuario::LST_SEXOS[$this->sexo]; 
    }

    /**
     * Muestra una cadena representativa del usuario
     */
    function __toString() {
        return sprintf('[%s:%s:%s:%s:%s:%s]',
            $this->id,
            $this->nombre,
            $this->nacido,
            $this->getDenominacionSexo(),
            $this->getDeportes(),
            $this->foto
        );
    }
}

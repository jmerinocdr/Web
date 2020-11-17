<?php
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Psswd")
 */

class Passwd{

    /**
    * @ORM\id
    * @ORM\Column(type="string")
    */
    protected $nombre;

    /**
    * @ORM\Column(type="string")
    */
    protected $contrasena;

    public function __construct($nombre, $contrasena) {
        $this->deportes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->setNombre($nombre);
        $this->setContrasena($contrasena);
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getContrasena()
    {
        return $this->contrasena;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
    public function setContrasena($contrasena)
    {
        $this->contrasena = $contrasena;
    }
}
<?php
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Usuario")
 */

class Usuario{

    /**
    * @ORM\Id
    * @ORM\Column(name="id", type="integer")
    * @ORM\GeneratedValue
    */
    protected $id;

    /**
    * @ORM\Column(type="string")
    */
    protected $nombre;

    /**
    * Muchos usuarios tienen muchos Deportes
    * @ORM\ManyToMany(targetEntity="Deporte", inversedBy="Usuario")
    * @ORM\JoinTable(name="Usuario_Deporte")
    */
    private $deportes;

    public function __construct() {
        $this->deportes = new \Doctrine\Common\Collections\ArrayCollection();
    }


    public function getId()
    {
        return $this->id;
    }

    public function getDeportes()
    {
        return $this->deportes;
    }
    public function setDeportes($deportes)
    {
        $this->deportes = $deportes;
    }

    public function getNombre()
    {
        return $this->nombre;
    }
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
}
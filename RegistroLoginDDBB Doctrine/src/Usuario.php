<?php
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Usuario")
 */

class Usuario{

    /*
    * @ORM\id
    * @ORM\Column(type"integer")
    * @ORM\GeneratedValue
    */
    protected $id;

    /*
    * @ORM\Column(type"string")
    */
    protected $nombre;

     /**
     * Muchos usuarios tienen muchos Deportes
     * @ORM\ManyToMany(targetEntity="Deporte", inversedBy="Usuario")
     * @ORM\JoinTable(name="Usuario_Deporte")
     */
    private $Deportes;

    public function __construct() {
        $this->Deportes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getDeportes()
    {
        return $this->deportes;
    }
    public function setDeportes($deportes)
    {
        $this->deportes = $deportes;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
}
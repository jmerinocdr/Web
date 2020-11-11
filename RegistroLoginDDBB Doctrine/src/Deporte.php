<?php
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Deporte")
 */

class Deporte{
    
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
     * @ORM\ManyToMany(targetEntity="Usuario", inversedBy="Deporte")
     * @ORM\JoinTable(name="Usuario_Deporte")
     */
    private $Usuarios;

    public function __construct() {
        $this->Usuarios = new \Doctrine\Common\Collections\ArrayCollection();
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
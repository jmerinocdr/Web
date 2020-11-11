<?php
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Usuario")
 */

class Usuario{

    /**
    * @ManyToMany(targetEntity="Deporte")
    * @JoinTable(name="Usuario_Deporte",
    *      joinColumns={@JoinColumn(name="Usuario_id", referencedColumnName="id")},
    *      inverseJoinColumns={@JoinColumn(name="Deporte_id", referencedColumnName="id", unique=true)}
    *      )
    */
    protected $deportes;

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


    public function __construct() {
        $this->deportes = new \Doctrine\Common\Collections\ArrayCollection();
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
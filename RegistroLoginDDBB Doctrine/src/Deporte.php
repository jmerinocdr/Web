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
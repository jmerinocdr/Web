<?php
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Deporte")
 */

class Deporte{
    
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
    * @ORM\ManyToMany(targetEntity="Usuario", mappedBy="Deporte")
    */
    private $usuarios;

    public function __construct() {
        $this->usuarios = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function addUsuario(Usuario $usuario)
    {
        if ($this->usuarios->contains($usuario)) {
            return;
        }

        $this->usuarios->add($usuario);
        $usuario->addUsuario($this);
    }

    public function getUsuarios()
    {
        return $this->usuarios;
    }
    public function setUsuarios($usuarios)
    {
        $this->usuarios = $usuarios;
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
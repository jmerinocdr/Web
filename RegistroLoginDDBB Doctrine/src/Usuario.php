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
    * @ORM\Column(type="date")
    */
    protected $fnacimiento;

    /**
    * @ORM\Column(type="string")
    */
    protected $sexo;

    /**
    * @ORM\Column(type="string")
    */
    protected $foto;

    /**
    * Muchos usuarios tienen muchos Deportes
    * @ORM\ManyToMany(targetEntity="Deporte", inversedBy="Usuario")
    * @ORM\JoinTable(name="Usuario_Deporte")
    */
    private $deportes;

    public function __construct($nombre, $fnacimiento, $sexo, $foto) {
        $this->deportes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->setNombre($nombre);
        $this->setFnacimiento($fnacimiento);
        $this->setSexo($sexo);
        $this->setFoto($foto);
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

    public function getFnacimiento()
    {
        return $this->fnacimiento;
    }
    public function setFnacimiento($fnacimiento)
    {
        $this->fnacimiento = $fnacimiento;
    }

    public function getSexo()
    {
        return $this->sexo;
    }
    public function setSexo($sexo)
    {
        if($sexo=='H'||$sexo=='M'){
            $this->sexo = $sexo; 
        }
    }

    public function getFoto()
    {
        return $this->foto;
    }
    public function setFoto($foto)
    {
        $this->foto = $foto;
    }
}
<?php

namespace App\Entity;

use App\Repository\ProductoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductoRepository::class)
 */
class Producto
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $Nombre;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $Descripcion;

    /**
     * @ORM\Column(type="float")
     */
    private $Peso;

    /**
     * @ORM\Column(type="float")
     */
    private $Precio;

    /**
     * @ORM\Column(type="integer")
     */
    private $Stock;

    /**
     * @ORM\ManyToOne(targetEntity=Categoria::class, inversedBy="Producto")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categoria;

    /**
     * @ORM\ManyToMany(targetEntity=Pedido::class, mappedBy="Producto")
     */
    private $pedidos;

    public function __construct()
    {
        $this->pedidos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->Nombre;
    }

    public function setNombre(string $Nombre): self
    {
        $this->Nombre = $Nombre;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->Descripcion;
    }

    public function setDescripcion(string $Descripcion): self
    {
        $this->Descripcion = $Descripcion;

        return $this;
    }

    public function getPeso(): ?float
    {
        return $this->Peso;
    }

    public function setPeso(float $Peso): self
    {
        $this->Peso = $Peso;

        return $this;
    }

    public function getPrecio(): ?float
    {
        return $this->Precio;
    }

    public function setPrecio(float $Precio): self
    {
        $this->Precio = $Precio;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->Stock;
    }

    public function setStock(int $Stock): self
    {
        $this->Stock = $Stock;

        return $this;
    }

    public function getCategoria(): ?Categoria
    {
        return $this->categoria;
    }

    public function setCategoria(?Categoria $categoria): self
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * @return Collection|Pedido[]
     */
    public function getPedidos(): Collection
    {
        return $this->pedidos;
    }

    public function addPedido(Pedido $pedido): self
    {
        if (!$this->pedidos->contains($pedido)) {
            $this->pedidos[] = $pedido;
            $pedido->addProducto($this);
        }

        return $this;
    }

    public function removePedido(Pedido $pedido): self
    {
        if ($this->pedidos->removeElement($pedido)) {
            $pedido->removeProducto($this);
        }

        return $this;
    }
}

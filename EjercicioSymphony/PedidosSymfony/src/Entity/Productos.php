<?php

namespace App\Entity;

use App\Repository\ProductosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductosRepository::class)
 */
class Productos
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $CodProd;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $Nombre;

    /**
     * @ORM\Column(type="string", length=90)
     */
    private $Descripcion;

    /**
     * @ORM\Column(type="float")
     */
    private $Peso;

    /**
     * @ORM\Column(type="integer")
     */
    private $Stock;

    /**
     * @ORM\ManyToOne(targetEntity=Categorias::class, inversedBy="productos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Categoria;

    /**
     * @ORM\ManyToMany(targetEntity=Pedidos::class, inversedBy="productos")
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

    public function getCodProd(): ?int
    {
        return $this->CodProd;
    }

    public function setCodProd(int $CodProd): self
    {
        $this->CodProd = $CodProd;

        return $this;
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

    public function getStock(): ?int
    {
        return $this->Stock;
    }

    public function setStock(int $Stock): self
    {
        $this->Stock = $Stock;

        return $this;
    }

    public function getCategoria(): ?Categorias
    {
        return $this->Categoria;
    }

    public function setCategoria(?Categorias $Categoria): self
    {
        $this->Categoria = $Categoria;

        return $this;
    }

    /**
     * @return Collection|Pedidos[]
     */
    public function getPedidos(): Collection
    {
        return $this->pedidos;
    }

    public function addPedido(Pedidos $pedido): self
    {
        if (!$this->pedidos->contains($pedido)) {
            $this->pedidos[] = $pedido;
        }

        return $this;
    }

    public function removePedido(Pedidos $pedido): self
    {
        $this->pedidos->removeElement($pedido);

        return $this;
    }
}

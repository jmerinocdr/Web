<?php

namespace App\Entity;

use App\Repository\PedidoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PedidoRepository::class)
 */
class Pedido
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $Fecha;

    /**
     * @ORM\Column(type="float")
     */
    private $Peso;

    /**
     * @ORM\Column(type="float")
     */
    private $Precio;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Enviado;

    /**
     * @ORM\ManyToMany(targetEntity=Producto::class, inversedBy="pedidos")
     */
    private $Producto;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="Pedido")
     */
    private $user;

    public function __construct()
    {
        $this->Producto = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->Fecha;
    }

    public function setFecha(\DateTimeInterface $Fecha): self
    {
        $this->Fecha = $Fecha;

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

    public function getEnviado(): ?bool
    {
        return $this->Enviado;
    }

    public function setEnviado(bool $Enviado): self
    {
        $this->Enviado = $Enviado;

        return $this;
    }

    /**
     * @return Collection|Producto[]
     */
    public function getProducto(): Collection
    {
        return $this->Producto;
    }

    public function addProducto(Producto $producto): self
    {
        if (!$this->Producto->contains($producto)) {
            $this->Producto[] = $producto;
        }

        return $this;
    }

    public function removeProducto(Producto $producto): self
    {
        $this->Producto->removeElement($producto);

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}

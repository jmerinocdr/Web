<?php

namespace App\Entity;

use App\Repository\PedidosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PedidosRepository::class)
 */
class Pedidos
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
    private $CodPed;

    /**
     * @ORM\Column(type="date")
     */
    private $Fecha;

    /**
     * @ORM\Column(type="integer")
     */
    private $Enviado;

    /**
     * @ORM\ManyToOne(targetEntity=Restaurantes::class, inversedBy="pedidos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Restaurante;

    /**
     * @ORM\ManyToMany(targetEntity=Productos::class, mappedBy="pedidos")
     */
    private $productos;

    public function __construct()
    {
        $this->productos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodPed(): ?int
    {
        return $this->CodPed;
    }

    public function setCodPed(int $CodPed): self
    {
        $this->CodPed = $CodPed;

        return $this;
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

    public function getEnviado(): ?int
    {
        return $this->Enviado;
    }

    public function setEnviado(int $Enviado): self
    {
        $this->Enviado = $Enviado;

        return $this;
    }

    public function getRestaurante(): ?Restaurantes
    {
        return $this->Restaurante;
    }

    public function setRestaurante(?Restaurantes $Restaurante): self
    {
        $this->Restaurante = $Restaurante;

        return $this;
    }

    /**
     * @return Collection|Productos[]
     */
    public function getProductos(): Collection
    {
        return $this->productos;
    }

    public function addProducto(Productos $producto): self
    {
        if (!$this->productos->contains($producto)) {
            $this->productos[] = $producto;
            $producto->addPedido($this);
        }

        return $this;
    }

    public function removeProducto(Productos $producto): self
    {
        if ($this->productos->removeElement($producto)) {
            $producto->removePedido($this);
        }

        return $this;
    }
}

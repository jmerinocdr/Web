<?php

namespace App\Entity;

use App\Repository\PhotoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PhotoRepository::class)
 */
class Photo
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
    private $Name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $DateTime;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $Device;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $Opening;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $Speed;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $ISO;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Latitude;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Longitude;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Favourite;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Hidden;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Archive;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Keywords;

    /**
     * @ORM\ManyToMany(targetEntity=Album::class, mappedBy="Photos")
     */
    private $albums;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Path;

    public function __construct()
    {
        $this->albums = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(?string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getDateTime(): ?\DateTimeInterface
    {
        return $this->DateTime;
    }

    public function setDateTime(\DateTimeInterface $DateTime): self
    {
        $this->DateTime = $DateTime;

        return $this;
    }

    public function getDevice(): ?string
    {
        return $this->Device;
    }

    public function setDevice(?string $Device): self
    {
        $this->Device = $Device;

        return $this;
    }

    public function getOpening(): ?float
    {
        return $this->Opening;
    }

    public function setOpening(?float $Opening): self
    {
        $this->Opening = $Opening;

        return $this;
    }

    public function getSpeed(): ?float
    {
        return $this->Speed;
    }

    public function setSpeed(?float $Speed): self
    {
        $this->Speed = $Speed;

        return $this;
    }

    public function getISO(): ?int
    {
        return $this->ISO;
    }

    public function setISO(?int $ISO): self
    {
        $this->ISO = $ISO;

        return $this;
    }

    public function getLatitude(): ?int
    {
        return $this->Latitude;
    }

    public function setLatitude(?int $Latitude): self
    {
        $this->Latitude = $Latitude;

        return $this;
    }

    public function getLongitude(): ?int
    {
        return $this->Longitude;
    }

    public function setLongitude(?int $Longitude): self
    {
        $this->Longitude = $Longitude;

        return $this;
    }

    public function getFavourite(): ?bool
    {
        return $this->Favourite;
    }

    public function setFavourite(bool $Favourite): self
    {
        $this->Favourite = $Favourite;

        return $this;
    }

    public function getHidden(): ?bool
    {
        return $this->Hidden;
    }

    public function setHidden(bool $Hidden): self
    {
        $this->Hidden = $Hidden;

        return $this;
    }

    public function getArchive(): ?bool
    {
        return $this->Archive;
    }

    public function setArchive(bool $Archive): self
    {
        $this->Archive = $Archive;

        return $this;
    }

    public function getKeywords(): ?string
    {
        return $this->Keywords;
    }

    public function setKeywords(?string $Keywords): self
    {
        $this->Keywords = $Keywords;

        return $this;
    }

    /**
     * @return Collection|Album[]
     */
    public function getAlbums(): Collection
    {
        return $this->albums;
    }

    public function addAlbum(Album $album): self
    {
        if (!$this->albums->contains($album)) {
            $this->albums[] = $album;
            $album->addPhoto($this);
        }

        return $this;
    }

    public function removeAlbum(Album $album): self
    {
        if ($this->albums->removeElement($album)) {
            $album->removePhoto($this);
        }

        return $this;
    }

    public function getPath(): ?string
    {
        return $this->Path;
    }

    public function setPath(string $Path): self
    {
        $this->Path = $Path;

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\AlbumRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AlbumRepository::class)
 */
class Album
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
     * @ORM\ManyToOne(targetEntity=Photo::class)
     */
    private $Cover;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Shared;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Hidden;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Favourite;

    /**
     * @ORM\ManyToMany(targetEntity=Photo::class, inversedBy="albums")
     */
    private $Photos;

    public function __construct()
    {
        $this->Photos = new ArrayCollection();
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

    public function getCover(): ?Photo
    {
        return $this->Cover;
    }

    public function setCover(?Photo $Cover): self
    {
        $this->Cover = $Cover;

        return $this;
    }

    public function getShared(): ?bool
    {
        return $this->Shared;
    }

    public function setShared(bool $Shared): self
    {
        $this->Shared = $Shared;

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

    public function getFavourite(): ?bool
    {
        return $this->Favourite;
    }

    public function setFavourite(bool $Favourite): self
    {
        $this->Favourite = $Favourite;

        return $this;
    }

    /**
     * @return Collection|Photo[]
     */
    public function getPhotos(): Collection
    {
        return $this->Photos;
    }

    public function addPhoto(Photo $photo): self
    {
        if (!$this->Photos->contains($photo)) {
            $this->Photos[] = $photo;
        }

        return $this;
    }

    public function removePhoto(Photo $photo): self
    {
        $this->Photos->removeElement($photo);

        return $this;
    }
}

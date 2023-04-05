<?php

namespace App\Entity;

use App\Repository\PisteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PisteRepository::class)]
class Piste
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titreP = null;

    #[ORM\Column(nullable: true)]
    private ?int $duree = null;

    #[ORM\Column]
    private ?int $numP = null;

    #[ORM\ManyToOne(inversedBy: 'pistes')]
    private ?Album $album = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitreP(): ?string
    {
        return $this->titreP;
    }

    public function setTitreP(string $titreP): self
    {
        $this->titreP = $titreP;

        return $this;
    }

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(?int $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getNumP(): ?int
    {
        return $this->numP;
    }

    public function setNumP(int $numP): self
    {
        $this->numP = $numP;

        return $this;
    }

    public function getAlbum(): ?Album
    {
        return $this->album;
    }

    public function setAlbum(?Album $album): self
    {
        $this->album = $album;

        return $this;
    }
}

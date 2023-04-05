<?php

namespace App\Entity;

use App\Repository\AlbumRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AlbumRepository::class)]
class Album
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titreA = null;

    #[ORM\Column]
    private ?int $dateSortie = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $pochette = null;

    #[ORM\ManyToMany(targetEntity: Genre::class, inversedBy: 'albums')]
    private Collection $genre;

    #[ORM\ManyToOne(inversedBy: 'albums')]
    private ?Artiste $artiste = null;

    #[ORM\OneToMany(mappedBy: 'album', targetEntity: Piste::class)]
    private Collection $pistes;

    public function __construct()
    {
        $this->genre = new ArrayCollection();
        $this->pistes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitreA(): ?string
    {
        return $this->titreA;
    }

    public function setTitreA(string $titreA): self
    {
        $this->titreA = $titreA;

        return $this;
    }

    public function getDateSortie(): ?int
    {
        return $this->dateSortie;
    }

    public function setDateSortie(int $dateSortie): self
    {
        $this->dateSortie = $dateSortie;

        return $this;
    }

    public function getPochette(): ?string
    {
        return $this->pochette;
    }

    public function setPochette(?string $pochette): self
    {
        $this->pochette = $pochette;

        return $this;
    }

    /**
     * @return Collection<int, Genre>
     */
    public function getGenre(): Collection
    {
        return $this->genre;
    }

    public function addGenre(Genre $genre): self
    {
        if (!$this->genre->contains($genre)) {
            $this->genre->add($genre);
        }

        return $this;
    }

    public function removeGenre(Genre $genre): self
    {
        $this->genre->removeElement($genre);

        return $this;
    }

    public function getArtiste(): ?Artiste
    {
        return $this->artiste;
    }

    public function setArtiste(?Artiste $artiste): self
    {
        $this->artiste = $artiste;

        return $this;
    }

    /**
     * @return Collection<int, Piste>
     */
    public function getPistes(): Collection
    {
        return $this->pistes;
    }

    public function addPiste(Piste $piste): self
    {
        if (!$this->pistes->contains($piste)) {
            $this->pistes->add($piste);
            $piste->setAlbum($this);
        }

        return $this;
    }

    public function removePiste(Piste $piste): self
    {
        if ($this->pistes->removeElement($piste)) {
            // set the owning side to null (unless already changed)
            if ($piste->getAlbum() === $this) {
                $piste->setAlbum(null);
            }
        }

        return $this;
    }
}

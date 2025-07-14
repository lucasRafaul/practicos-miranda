<?php

namespace App\Entity;

use App\Repository\ProvinciaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProvinciaRepository::class)]
class Provincia
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nombre = null;

    #[ORM\ManyToOne(inversedBy: 'provincias')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Pais $pais = null;

    /**
     * @var Collection<int, Ubicacion>
     */
    #[ORM\OneToMany(targetEntity: Ubicacion::class, mappedBy: 'provincia')]
    private Collection $ubicaciones;

    public function __construct()
    {
        $this->ubicaciones = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getPais(): ?Pais
    {
        return $this->pais;
    }

    public function setPais(?Pais $pais): static
    {
        $this->pais = $pais;

        return $this;
    }

    /**
     * @return Collection<int, Ubicacion>
     */
    public function getUbicaciones(): Collection
    {
        return $this->ubicaciones;
    }

    public function addUbicacione(Ubicacion $ubicacione): static
    {
        if (!$this->ubicaciones->contains($ubicacione)) {
            $this->ubicaciones->add($ubicacione);
            $ubicacione->setProvincia($this);
        }

        return $this;
    }

    public function removeUbicacione(Ubicacion $ubicacione): static
    {
        if ($this->ubicaciones->removeElement($ubicacione)) {
            // set the owning side to null (unless already changed)
            if ($ubicacione->getProvincia() === $this) {
                $ubicacione->setProvincia(null);
            }
        }

        return $this;
    }
}

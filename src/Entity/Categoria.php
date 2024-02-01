<?php

namespace App\Entity;

use App\Repository\CategoriaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: CategoriaRepository::class)]
#[Broadcast]
class Categoria
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $nombre = null;

    #[ORM\OneToMany(mappedBy: 'categoria', targetEntity: Material::class)]
    private Collection $materiales;

    public function __construct()
    {
        $this->materiales = new ArrayCollection();
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

    /**
     * @return Collection<int, Material>
     */
    public function getMateriales(): Collection
    {
        return $this->materiales;
    }

    public function addMateriale(Material $materiale): static
    {
        if (!$this->materiales->contains($materiale)) {
            $this->materiales->add($materiale);
            $materiale->setCategoria($this);
        }

        return $this;
    }

    public function removeMateriale(Material $materiale): static
    {
        if ($this->materiales->removeElement($materiale)) {
            // set the owning side to null (unless already changed)
            if ($materiale->getCategoria() === $this) {
                $materiale->setCategoria(null);
            }
        }

        return $this;
    }
}

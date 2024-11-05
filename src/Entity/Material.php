<?php

namespace App\Entity;

use App\Repository\MaterialRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: MaterialRepository::class)]
#[Broadcast]
class Material
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $nombre = null;

    #[ORM\Column(length: 155)]
    private ?string $unidad_medida = null;

    #[ORM\OneToMany(mappedBy: 'material', targetEntity: Entrada::class)]
    private Collection $entradas;

    #[ORM\OneToMany(mappedBy: 'material', targetEntity: Salida::class)]
    private Collection $salidas;

    #[ORM\Column(length: 155)]
    private ?string $familia = null;

    #[ORM\Column(length: 155)]
    private ?string $subfamilia = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $descripcion = null;

    public function __construct()
    {
        $this->entradas = new ArrayCollection();
        $this->salidas = new ArrayCollection();
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

    public function getUnidadMedida(): ?string
    {
        return $this->unidad_medida;
    }

    public function setUnidadMedida(string $unidad_medida): static
    {
        $this->unidad_medida = $unidad_medida;

        return $this;
    }

    /**
     * @return Collection<int, Entrada>
     */
    public function getEntradas(): Collection
    {
        return $this->entradas;
    }

    public function addEntrada(Entrada $entrada): static
    {
        if (!$this->entradas->contains($entrada)) {
            $this->entradas->add($entrada);
            $entrada->setMaterial($this);
        }

        return $this;
    }

    public function removeEntrada(Entrada $entrada): static
    {
        if ($this->entradas->removeElement($entrada)) {
            // set the owning side to null (unless already changed)
            if ($entrada->getMaterial() === $this) {
                $entrada->setMaterial(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Salida>
     */
    public function getSalidas(): Collection
    {
        return $this->salidas;
    }

    public function addSalida(Salida $salida): static
    {
        if (!$this->salidas->contains($salida)) {
            $this->salidas->add($salida);
            $salida->setMaterial($this);
        }

        return $this;
    }

    public function removeSalida(Salida $salida): static
    {
        if ($this->salidas->removeElement($salida)) {
            // set the owning side to null (unless already changed)
            if ($salida->getMaterial() === $this) {
                $salida->setMaterial(null);
            }
        }

        return $this;
    }

    public function getFamilia(): ?string
    {
        return $this->familia;
    }

    public function setFamilia(string $familia): static
    {
        $this->familia = $familia;

        return $this;
    }

    public function getSubfamilia(): ?string
    {
        return $this->subfamilia;
    }

    public function setSubfamilia(string $subfamilia): static
    {
        $this->subfamilia = $subfamilia;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): static
    {
        $this->descripcion = $descripcion;

        return $this;
    }
}

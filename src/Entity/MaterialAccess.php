<?php

namespace App\Entity;

use App\Repository\MaterialAccessRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MaterialAccessRepository::class)]
class MaterialAccess
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 155)]
    private ?string $familia = null;

    #[ORM\Column(length: 155)]
    private ?string $subfamilia = null;

    #[ORM\Column(length: 255)]
    private ?string $unidad_medida = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $descripcion = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getUnidadMedida(): ?string
    {
        return $this->unidad_medida;
    }

    public function setUnidadMedida(string $unidad_medida): static
    {
        $this->unidad_medida = $unidad_medida;

        return $this;
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

<?php

namespace App\Entity;

use App\Repository\EntradaRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: EntradaRepository::class)]
#[Broadcast]
class Entrada
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $precio_compra = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $fecha = null;

    #[ORM\Column]
    private ?int $proyecto = null;

    #[ORM\ManyToOne(inversedBy: 'entradas')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Material $material = null;

    #[ORM\ManyToOne(inversedBy: 'entradas')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Captura $Captura = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrecioCompra(): ?float
    {
        return $this->precio_compra;
    }

    public function setPrecioCompra(float $precio_compra): static
    {
        $this->precio_compra = $precio_compra;

        return $this;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): static
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getProyecto(): ?int
    {
        return $this->proyecto;
    }

    public function setProyecto(int $proyecto): static
    {
        $this->proyecto = $proyecto;

        return $this;
    }

    public function getMaterial(): ?Material
    {
        return $this->material;
    }

    public function setMaterial(?Material $material): static
    {
        $this->material = $material;

        return $this;
    }

    public function getCaptura(): ?Captura
    {
        return $this->Captura;
    }

    public function setCaptura(?Captura $Captura): static
    {
        $this->Captura = $Captura;

        return $this;
    }
}

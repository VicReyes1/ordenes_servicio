<?php

namespace App\Entity;

use App\Repository\SalidaRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: SalidaRepository::class)]
#[Broadcast]
class Salida
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?float $precio_salida = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $fecha = null;

    #[ORM\ManyToOne(inversedBy: 'salidas')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Material $material = null;

    #[ORM\ManyToOne(inversedBy: 'salidas')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Captura $captura = null;

    #[ORM\Column]
    private ?int $cantidad = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Nota $nota = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrecioSalida(): ?float
    {
        return $this->precio_salida;
    }

    public function setPrecioSalida(?float $precio_salida): static
    {
        $this->precio_salida = $precio_salida;

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
        return $this->captura;
    }

    public function setCaptura(?Captura $captura): static
    {
        $this->captura = $captura;

        return $this;
    }

    public function getCantidad(): ?int
    {
        return $this->cantidad;
    }

    public function setCantidad(int $cantidad): static
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    public function getNota(): ?Nota
    {
        return $this->nota;
    }

    public function setNota(?Nota $nota): static
    {
        $this->nota = $nota;

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\NotaHasMaterialesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NotaHasMaterialesRepository::class)]
class NotaHasMateriales
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Nota $nota = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Material $Material = null;

    #[ORM\Column]
    private ?float $cantidad = null;



    public function getId(): ?int
    {
        return $this->id;
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

    public function getMaterial(): ?Material
    {
        return $this->Material;
    }

    public function setMaterial(?Material $Material): static
    {
        $this->Material = $Material;

        return $this;
    }

    public function getCantidad(): ?float
    {
        return $this->cantidad;
    }

    public function setCantidad(float $cantidad): static
    {
        $this->cantidad = $cantidad;

        return $this;
    }

}

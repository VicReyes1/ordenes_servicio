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

    #[ORM\Column(length: 50)]
    private ?string $estatus = null;

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

    public function getEstatus(): ?string
    {
        return $this->estatus;
    }

    public function setEstatus(string $estatus): static
    {
        $this->estatus = $estatus;

        return $this;
    }
}

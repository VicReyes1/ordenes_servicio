<?php

namespace App\Entity;

use App\Repository\PersonalRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PersonalRepository::class)]
class Personal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\ManyToOne]
    private ?Ocupacion $ocupacion = null;

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

    public function getOcupacion(): ?Ocupacion
    {
        return $this->ocupacion;
    }

    public function setOcupacion(?Ocupacion $ocupacion): static
    {
        $this->ocupacion = $ocupacion;

        return $this;
    }
}

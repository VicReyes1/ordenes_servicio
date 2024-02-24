<?php

namespace App\Entity;

use App\Repository\OcupacionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OcupacionRepository::class)]
class Ocupacion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 155)]
    private ?string $ocupacion = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOcupacion(): ?string
    {
        return $this->ocupacion;
    }

    public function setOcupacion(string $ocupacion): static
    {
        $this->ocupacion = $ocupacion;

        return $this;
    }
}

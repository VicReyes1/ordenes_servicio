<?php

namespace App\Entity;

use App\Repository\CapturaHasPersonalRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CapturaHasPersonalRepository::class)]
class CapturaHasPersonal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Captura $captura = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Categoria $tipo = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Personal $trabajador = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTipo(): ?Categoria
    {
        return $this->tipo;
    }

    public function setTipo(?Categoria $tipo): static
    {
        $this->tipo = $tipo;

        return $this;
    }

    public function getTrabajador(): ?Personal
    {
        return $this->trabajador;
    }

    public function setTrabajador(?Personal $trabajador): static
    {
        $this->trabajador = $trabajador;

        return $this;
    }
}

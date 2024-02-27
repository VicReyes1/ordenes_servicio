<?php

namespace App\Entity;

use App\Repository\LevantamientoHasMaterialesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LevantamientoHasMaterialesRepository::class)]
class LevantamientoHasMateriales
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Levantamiento $levantamiento = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Material $material = null;

    #[ORM\Column(nullable: true)]
    private ?float $cantidad = null;

    #[ORM\Column(nullable: true)]
    private ?float $cantidad_al_solicitar = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLevantamiento(): ?Levantamiento
    {
        return $this->levantamiento;
    }

    public function setLevantamiento(?Levantamiento $levantamiento): static
    {
        $this->levantamiento = $levantamiento;

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

    public function getCantidad(): ?float
    {
        return $this->cantidad;
    }

    public function setCantidad(?float $cantidad): static
    {
        $this->cantidad = $cantidad;

        return $this;
    }


    public function getCantidadAlSolicitar(): ?float
    {
        return $this->cantidad_al_solicitar;
    }

    public function setCantidadAlSolicitar(?float $cantidad_al_solicitar): static
    {
        $this->cantidad_al_solicitar = $cantidad_al_solicitar;

        return $this;
    }
}

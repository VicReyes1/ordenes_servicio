<?php

namespace App\Entity;

use App\Repository\LevantamientoRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LevantamientoRepository::class)]
class Levantamiento
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Captura $captura = null;

    #[ORM\Column(length: 155, nullable: true)]
    private ?string $imagen1 = null;

    #[ORM\Column(length: 155, nullable: true)]
    private ?string $imagen2 = null;

    #[ORM\Column(length: 155, nullable: true)]
    private ?string $imagen3 = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $fecha_levantamiento = null;

    #[ORM\ManyToOne]
    private ?Categoria $categoria = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nombre_solicitante = null;

    #[ORM\ManyToOne]
    private ?Personal $jefe_cuadrilla = null;

    #[ORM\ManyToOne]
    private ?Personal $supervisor = null;

    #[ORM\Column(length: 155)]
    private ?string $solicitante_firma = null;

    #[ORM\Column(length: 155, nullable: true)]
    private ?string $jefe_cuadrilla_firma = null;

    #[ORM\Column(length: 155, nullable: true)]
    private ?string $supervisor_firma = null;

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

    public function getImagen1(): ?string
    {
        return $this->imagen1;
    }

    public function setImagen1(?string $imagen1): static
    {
        $this->imagen1 = $imagen1;

        return $this;
    }

    public function getImagen2(): ?string
    {
        return $this->imagen2;
    }

    public function setImagen2(?string $imagen2): static
    {
        $this->imagen2 = $imagen2;

        return $this;
    }

    public function getImagen3(): ?string
    {
        return $this->imagen3;
    }

    public function setImagen3(?string $imagen3): static
    {
        $this->imagen3 = $imagen3;

        return $this;
    }


    public function getFechaLevantamiento(): ?\DateTimeInterface
    {
        return $this->fecha_levantamiento;
    }

    public function setFechaLevantamiento(?\DateTimeInterface $fecha_levantamiento): static
    {
        $this->fecha_levantamiento = $fecha_levantamiento;

        return $this;
    }

    public function getCategoria(): ?Categoria
    {
        return $this->categoria;
    }

    public function setCategoria(?Categoria $categoria): static
    {
        $this->categoria = $categoria;

        return $this;
    }

    public function getNombreSolicitante(): ?string
    {
        return $this->nombre_solicitante;
    }

    public function setNombreSolicitante(?string $nombre_solicitante): static
    {
        $this->nombre_solicitante = $nombre_solicitante;

        return $this;
    }

    public function getJefeCuadrilla(): ?Personal
    {
        return $this->jefe_cuadrilla;
    }

    public function setJefeCuadrilla(?Personal $jefe_cuadrilla): static
    {
        $this->jefe_cuadrilla = $jefe_cuadrilla;

        return $this;
    }

    public function getSupervisor(): ?Personal
    {
        return $this->supervisor;
    }

    public function setSupervisor(?Personal $supervisor): static
    {
        $this->supervisor = $supervisor;

        return $this;
    }

    public function getSolicitanteFirma(): ?string
    {
        return $this->solicitante_firma;
    }

    public function setSolicitanteFirma(string $solicitante_firma): static
    {
        $this->solicitante_firma = $solicitante_firma;

        return $this;
    }

    public function getJefeCuadrillaFirma(): ?string
    {
        return $this->jefe_cuadrilla_firma;
    }

    public function setJefeCuadrillaFirma(?string $jefe_cuadrilla_firma): static
    {
        $this->jefe_cuadrilla_firma = $jefe_cuadrilla_firma;

        return $this;
    }

    public function getSupervisorFirma(): ?string
    {
        return $this->supervisor_firma;
    }

    public function setSupervisorFirma(?string $supervisor_firma): static
    {
        $this->supervisor_firma = $supervisor_firma;

        return $this;
    }
}

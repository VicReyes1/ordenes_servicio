<?php

namespace App\Entity;

use App\Repository\CapturaRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CapturaRepository::class)]
class Captura
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $fecha = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $area_solicitante = null;

    #[ORM\Column(length: 355, nullable: true)]
    private ?string $centro_trabajo = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nombre_solicitante = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $puesto_solicitante = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $telefono_ext = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $tipo_trabajo = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $descripcion_trabajo = null;

    #[ORM\Column(nullable: true)]
    private ?bool $gas = null;

    #[ORM\Column(nullable: true)]
    private ?bool $flama = null;

    #[ORM\Column(nullable: true)]
    private ?bool $altura = null;

    #[ORM\Column(length: 1000, nullable: true)]
    private ?string $especialidad = null;

    #[ORM\ManyToOne]
    private ?Secretaria $secretaria = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getAreaSolicitante(): ?string
    {
        return $this->area_solicitante;
    }

    public function setAreaSolicitante(?string $area_solicitante): static
    {
        $this->area_solicitante = $area_solicitante;

        return $this;
    }

    public function getCentroTrabajo(): ?string
    {
        return $this->centro_trabajo;
    }

    public function setCentroTrabajo(?string $centro_trabajo): static
    {
        $this->centro_trabajo = $centro_trabajo;

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

    public function getPuestoSolicitante(): ?string
    {
        return $this->puesto_solicitante;
    }

    public function setPuestoSolicitante(?string $puesto_solicitante): static
    {
        $this->puesto_solicitante = $puesto_solicitante;

        return $this;
    }

    public function getTelefonoExt(): ?string
    {
        return $this->telefono_ext;
    }

    public function setTelefonoExt(?string $telefono_ext): static
    {
        $this->telefono_ext = $telefono_ext;

        return $this;
    }

    public function getTipoTrabajo(): ?string
    {
        return $this->tipo_trabajo;
    }

    public function setTipoTrabajo(?string $tipo_trabajo): static
    {
        $this->tipo_trabajo = $tipo_trabajo;

        return $this;
    }

    public function getDescripcionTrabajo(): ?string
    {
        return $this->descripcion_trabajo;
    }

    public function setDescripcionTrabajo(?string $descripcion_trabajo): static
    {
        $this->descripcion_trabajo = $descripcion_trabajo;

        return $this;
    }

    public function isGas(): ?bool
    {
        return $this->gas;
    }

    public function setGas(?bool $gas): static
    {
        $this->gas = $gas;

        return $this;
    }

    public function isFlama(): ?bool
    {
        return $this->flama;
    }

    public function setFlama(?bool $flama): static
    {
        $this->flama = $flama;

        return $this;
    }

    public function isAltura(): ?bool
    {
        return $this->altura;
    }

    public function setAltura(?bool $altura): static
    {
        $this->altura = $altura;

        return $this;
    }

    public function getEspecialidad(): ?string
    {
        return $this->especialidad;
    }

    public function setEspecialidad(?string $especialidad): static
    {
        $this->especialidad = $especialidad;

        return $this;
    }

    public function getSecretaria(): ?Secretaria
    {
        return $this->secretaria;
    }

    public function setSecretaria(?Secretaria $secretaria): static
    {
        $this->secretaria = $secretaria;

        return $this;
    }
}

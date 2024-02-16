<?php

namespace App\Entity;

use App\Repository\NotaRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NotaRepository::class)]
class Nota
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $fecha_peticion = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $observaciones = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Captura $captura = null;

    #[ORM\Column(length: 50)]
    private ?string $estatus = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imagen1 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imagen2 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imagen3 = null;

    #[ORM\Column(nullable: true)]
    private ?bool $gas = null;

    #[ORM\Column(nullable: true)]
    private ?bool $flama = null;

    #[ORM\Column(nullable: true)]
    private ?bool $altura = null;

    #[ORM\Column(nullable: true)]
    private ?bool $alta_tension = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $descripcion_trabajo_sol = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $descripcion_trabajo_ej = null;


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

    public function getFechaPeticion(): ?\DateTimeInterface
    {
        return $this->fecha_peticion;
    }

    public function setFechaPeticion(\DateTimeInterface $fecha_peticion): static
    {
        $this->fecha_peticion = $fecha_peticion;

        return $this;
    }

    public function getObservaciones(): ?string
    {
        return $this->observaciones;
    }

    public function setObservaciones(?string $observaciones): static
    {
        $this->observaciones = $observaciones;

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

    public function getEstatus(): ?string
    {
        return $this->estatus;
    }

    public function setEstatus(string $estatus): static
    {
        $this->estatus = $estatus;

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

    public function isAltaTension(): ?bool
    {
        return $this->alta_tension;
    }

    public function setAltaTension(?bool $alta_tension): static
    {
        $this->alta_tension = $alta_tension;

        return $this;
    }

    public function getDescripcionTrabajoSol(): ?string
    {
        return $this->descripcion_trabajo_sol;
    }

    public function setDescripcionTrabajoSol(?string $descripcion_trabajo_sol): static
    {
        $this->descripcion_trabajo_sol = $descripcion_trabajo_sol;

        return $this;
    }

    public function getDescripcionTrabajoEj(): ?string
    {
        return $this->descripcion_trabajo_ej;
    }

    public function setDescripcionTrabajoEj(?string $descripcion_trabajo_ej): static
    {
        $this->descripcion_trabajo_ej = $descripcion_trabajo_ej;

        return $this;
    }

    
}

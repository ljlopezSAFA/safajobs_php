<?php

namespace App\Entity;

use App\Repository\AptitudRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AptitudRepository::class)]
#[ORM\Table(name: 'aptitud', schema: 'safajobs')]
class Aptitud
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id')]
    private ?int $id = null;

    #[ORM\Column(name: 'tipo')]
    private ?int $tipo = null;

    #[ORM\Column(length: 255)]
    private ?string $titulo = null;

    #[ORM\Column(length: 255)]
    private ?string $detalle = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTipo(): ?int
    {
        return $this->tipo;
    }

    public function setTipo(int $tipo): static
    {
        $this->tipo = $tipo;

        return $this;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): static
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getDetalle(): ?string
    {
        return $this->detalle;
    }

    public function setDetalle(string $detalle): static
    {
        $this->detalle = $detalle;

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\AptitudRepository;
use Doctrine\ORM\Mapping as ORM;

enum TipoAptitud: int {
    case TECNOLOGICAS = 0;
    case HABILIDADES_COMUNICATIVAS = 1;
    case OFIMATICA = 2;
    case COMUNICATIVAS = 3;
}



#[ORM\Entity(repositoryClass: AptitudRepository::class)]
#[ORM\Table(name: 'aptitud', schema: 'safajobs')]
class Aptitud
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id')]
    private ?int $id = null;

    #[ORM\Column(name: 'tipo',type: 'integer' ,enumType: TipoAptitud::class)]
    private ?TipoAptitud $tipo = null;

    #[ORM\Column(length: 255)]
    private ?string $titulo = null;

    #[ORM\Column(length: 255)]
    private ?string $detalle = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTipo(): ? string
    {
        return $this->tipo->name;
    }

    public function setTipo(?TipoAptitud $tipo): void
    {
        $this->tipo = $tipo;
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

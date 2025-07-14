<?php

namespace App\Entity;

use App\Repository\EmpleadoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmpleadoRepository::class)]
class Empleado
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nombre = null;

    #[ORM\Column(length: 50)]
    private ?string $apellido = null;

    #[ORM\Column(length: 100)]
    private ?string $email = null;

    #[ORM\Column]
    private ?int $telefono = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $fechaIngreso = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 8, scale: 2)]
    private ?string $salario = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 8, scale: 2)]
    private ?string $comision = null;

    #[ORM\ManyToOne(inversedBy: 'empleados')]
    private ?Puesto $puesto = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'empleados')]
    private ?self $jefe = null;

    /**
     * @var Collection<int, self>
     */
    #[ORM\OneToMany(targetEntity: self::class, mappedBy: 'jefe')]
    private Collection $empleados;

    /**
     * @var Collection<int, Departamento>
     */
    #[ORM\OneToMany(targetEntity: Departamento::class, mappedBy: 'jefe')]
    private Collection $departamentos;

    #[ORM\ManyToOne(inversedBy: 'empleados')]
    private ?Departamento $departamento = null;

    /**
     * @var Collection<int, HistorialPuesto>
     */
    #[ORM\OneToMany(targetEntity: HistorialPuesto::class, mappedBy: 'empleado')]
    private Collection $historialPuestos;

    public function __construct()
    {
        $this->empleados = new ArrayCollection();
        $this->departamentos = new ArrayCollection();
        $this->historialPuestos = new ArrayCollection();
    }

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

    public function getApellido(): ?string
    {
        return $this->apellido;
    }

    public function setApellido(string $apellido): static
    {
        $this->apellido = $apellido;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getTelefono(): ?int
    {
        return $this->telefono;
    }

    public function setTelefono(int $telefono): static
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function getFechaIngreso(): ?\DateTimeInterface
    {
        return $this->fechaIngreso;
    }

    public function setFechaIngreso(\DateTimeInterface $fechaIngreso): static
    {
        $this->fechaIngreso = $fechaIngreso;

        return $this;
    }

    public function getSalario(): ?string
    {
        return $this->salario;
    }

    public function setSalario(string $salario): static
    {
        $this->salario = $salario;

        return $this;
    }

    public function getComision(): ?string
    {
        return $this->comision;
    }

    public function setComision(string $comision): static
    {
        $this->comision = $comision;

        return $this;
    }

    public function getPuesto(): ?Puesto
    {
        return $this->puesto;
    }

    public function setPuesto(?Puesto $puesto): static
    {
        $this->puesto = $puesto;

        return $this;
    }

    public function getJefe(): ?self
    {
        return $this->jefe;
    }

    public function setJefe(?self $jefe): static
    {
        $this->jefe = $jefe;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getEmpleados(): Collection
    {
        return $this->empleados;
    }

    public function addEmpleado(self $empleado): static
    {
        if (!$this->empleados->contains($empleado)) {
            $this->empleados->add($empleado);
            $empleado->setJefe($this);
        }

        return $this;
    }

    public function removeEmpleado(self $empleado): static
    {
        if ($this->empleados->removeElement($empleado)) {
            // set the owning side to null (unless already changed)
            if ($empleado->getJefe() === $this) {
                $empleado->setJefe(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Departamento>
     */
    public function getDepartamentos(): Collection
    {
        return $this->departamentos;
    }

    public function addDepartamento(Departamento $departamento): static
    {
        if (!$this->departamentos->contains($departamento)) {
            $this->departamentos->add($departamento);
            $departamento->setJefe($this);
        }

        return $this;
    }

    public function removeDepartamento(Departamento $departamento): static
    {
        if ($this->departamentos->removeElement($departamento)) {
            // set the owning side to null (unless already changed)
            if ($departamento->getJefe() === $this) {
                $departamento->setJefe(null);
            }
        }

        return $this;
    }

    public function getDepartamento(): ?Departamento
    {
        return $this->departamento;
    }

    public function setDepartamento(?Departamento $departamento): static
    {
        $this->departamento = $departamento;

        return $this;
    }

    /**
     * @return Collection<int, HistorialPuesto>
     */
    public function getHistorialPuestos(): Collection
    {
        return $this->historialPuestos;
    }

    public function addHistorialPuesto(HistorialPuesto $historialPuesto): static
    {
        if (!$this->historialPuestos->contains($historialPuesto)) {
            $this->historialPuestos->add($historialPuesto);
            $historialPuesto->setEmpleado($this);
        }

        return $this;
    }

    public function removeHistorialPuesto(HistorialPuesto $historialPuesto): static
    {
        if ($this->historialPuestos->removeElement($historialPuesto)) {
            // set the owning side to null (unless already changed)
            if ($historialPuesto->getEmpleado() === $this) {
                $historialPuesto->setEmpleado(null);
            }
        }

        return $this;
    }
}

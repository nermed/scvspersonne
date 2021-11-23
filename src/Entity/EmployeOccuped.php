<?php

namespace App\Entity;

use App\Repository\EmployeOccupedRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EmployeOccupedRepository::class)
 */
class EmployeOccuped
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=Employee::class, inversedBy="employeOccupeds")
     */
    private $employee;

    /**
     * @ORM\Column(type="integer")
     */
    private $commandeid;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $date_occupe;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $temps_occupe;

    public function __construct()
    {
        $this->employee = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Employee[]
     */
    public function getEmployee(): Collection
    {
        return $this->employee;
    }

    public function addEmployee(Employee $employee): self
    {
        if (!$this->employee->contains($employee)) {
            $this->employee[] = $employee;
        }

        return $this;
    }

    public function removeEmployee(Employee $employee): self
    {
        $this->employee->removeElement($employee);

        return $this;
    }

    public function getCommandeid(): ?int
    {
        return $this->commandeid;
    }

    public function setCommandeid(int $commandeid): self
    {
        $this->commandeid = $commandeid;

        return $this;
    }

    public function getDateOccupe(): ?string
    {
        return $this->date_occupe;
    }

    public function setDateOccupe(string $date_occupe): self
    {
        $this->date_occupe = $date_occupe;

        return $this;
    }

    public function getTempsOccupe(): ?string
    {
        return $this->temps_occupe;
    }

    public function setTempsOccupe(?string $temps_occupe): self
    {
        $this->temps_occupe = $temps_occupe;

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\AutreExperienceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AutreExperienceRepository::class)
 */
class AutreExperience
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=Employee::class, mappedBy="autreExperiences")
     */
    private $employee_id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imagePath;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getEmployeeId(): ?Employee
    {
        return $this->employee_id;
    }

    public function setEmployeeId(?Employee $employee_id): self
    {
        $this->employee_id = $employee_id;

        return $this;
    }

    public function getImagePath(): ?string
    {
        return $this->imagePath;
    }

    public function setImagePath(?string $imagePath): self
    {
        $this->imagePath = $imagePath;

        return $this;
    }
}

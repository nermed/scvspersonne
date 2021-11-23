<?php

namespace App\Entity;

use App\Repository\EmployeeRepository;
use DateTimeImmutable;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=EmployeeRepository::class)
 */
class Employee
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $first_name;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $last_name;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_naissance;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $niveau_academique;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $autre_experience;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="integer")
     */
    private $createdBy;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $modifyAt;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $modifyBy;

    /**
     * @ORM\ManyToMany(targetEntity=AutreExperience::class, inversedBy="employee_id")
     */
    private $autreExperiences;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imgPath;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $quartier;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $commune;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $province;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $rue;

    /**
     * @ORM\Column(type="boolean")
     */
    private $disponible = true;

    /**
     * @var File|null
     * @Assert\File(maxSize="5242880", mimeTypes={
     *  "image/png", 
     *  "image/jpeg", 
     *  "image/webp", 
     *  "application/pdf"})
     */
    private $imageFile;

    /**
     * @ORM\ManyToMany(targetEntity=EmployeOccuped::class, mappedBy="employee")
     */
    private $employeOccupeds;

    public function __construct()
    {
        $this->createdAt = new DateTimeImmutable();
        $this->createdBy = 1;
        $this->autreExperiences = new ArrayCollection();
        $this->employeOccupeds = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): self
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): self
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->date_naissance;
    }

    public function setDateNaissance(?\DateTimeInterface $date_naissance): self
    {
        $this->date_naissance = $date_naissance;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getNiveauAcademique(): ?string
    {
        return $this->niveau_academique;
    }

    public function setNiveauAcademique(?string $niveau_academique): self
    {
        $this->niveau_academique = $niveau_academique;

        return $this;
    }

    public function getAutreExperience(): ?string
    {
        return $this->autre_experience;
    }

    public function setAutreExperience(?string $autre_experience): self
    {
        $this->autre_experience = $autre_experience;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCreatedBy(): ?int
    {
        return $this->createdBy;
    }

    public function setCreatedBy(int $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    public function getModifyAt(): ?\DateTimeImmutable
    {
        return $this->modifyAt;
    }

    public function setModifyAt(?\DateTimeImmutable $modifyAt): self
    {
        $this->modifyAt = $modifyAt;

        return $this;
    }

    public function getModifyBy(): ?int
    {
        return $this->modifyBy;
    }

    public function setModifyBy(?int $modifyBy): self
    {
        $this->modifyBy = $modifyBy;

        return $this;
    }

    /**
     * @return Collection|AutreExperience[]
     */
    public function getAutreExperiences(): Collection
    {
        return $this->autreExperiences;
    }

    public function addAutreExperience(AutreExperience $autreExperience): self
    {
        if (!$this->autreExperiences->contains($autreExperience)) {
            $this->autreExperiences[] = $autreExperience;
            $autreExperience->setEmployeeId($this);
        }

        return $this;
    }

    public function removeAutreExperience(AutreExperience $autreExperience): self
    {
        if ($this->autreExperiences->removeElement($autreExperience)) {
            // set the owning side to null (unless already changed)
            if ($autreExperience->getEmployeeId() === $this) {
                $autreExperience->setEmployeeId(null);
            }
        }

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getImgPath(): ?string
    {
        return $this->imgPath;
    }

    public function setImgPath(?string $imgPath): self
    {
        $this->imgPath = $imgPath;

        return $this;
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    /**
     * @param ?File|null $imageFile
     * 
     * @return self
     */
    public function setImageFile(?File $imageFile): self
    {
        $this->imageFile = $imageFile;
        if ($imageFile) {
            $this->updated_at = new \DateTime('now');
        }

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getQuartier(): ?string
    {
        return $this->quartier;
    }

    public function setQuartier(?string $quartier): self
    {
        $this->quartier = $quartier;

        return $this;
    }

    public function getCommune(): ?string
    {
        return $this->commune;
    }

    public function setCommune(?string $commune): self
    {
        $this->commune = $commune;

        return $this;
    }

    public function getProvince(): ?string
    {
        return $this->province;
    }

    public function setProvince(?string $province): self
    {
        $this->province = $province;

        return $this;
    }

    public function getRue(): ?string
    {
        return $this->rue;
    }

    public function setRue(?string $rue): self
    {
        $this->rue = $rue;

        return $this;
    }

    public function getDisponible(): ?bool
    {
        return $this->disponible;
    }

    public function setDisponible(bool $disponible): self
    {
        $this->disponible = $disponible;

        return $this;
    }

    /**
     * @return Collection|EmployeOccuped[]
     */
    public function getEmployeOccupeds(): Collection
    {
        return $this->employeOccupeds;
    }

    public function addEmployeOccuped(EmployeOccuped $employeOccuped): self
    {
        if (!$this->employeOccupeds->contains($employeOccuped)) {
            $this->employeOccupeds[] = $employeOccuped;
            $employeOccuped->addEmployee($this);
        }

        return $this;
    }

    public function removeEmployeOccuped(EmployeOccuped $employeOccuped): self
    {
        if ($this->employeOccupeds->removeElement($employeOccuped)) {
            $employeOccuped->removeEmployee($this);
        }

        return $this;
    }
}

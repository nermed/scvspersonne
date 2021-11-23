<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\Components\Api\PaimentController;
use App\Repository\PaimentRepository;
use App\Entity\Commandes;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=PaimentRepository::class)
 */
#[ApiResource()]
class Paiment
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
    #[Groups(['post:Paiment'])]
    private $status;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(['post:Paiment', 'read:detail'])]
    private $code;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    #[Groups(['post:Paiment'])]
    private $montantPaie;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    #[Groups(['post:Paiment'])]
    private $totalPaie;

    /**
     * @ORM\Column(type="string", length=100)
     */
    #[Groups(['post:Paiment'])]
    private $branch;

    public function __construct()
    {
        $this->paiment = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getMontantPaie(): ?int
    {
        return $this->montantPaie;
    }

    public function setMontantPaie(?int $montantPaie): self
    {
        $this->montantPaie = $montantPaie;

        return $this;
    }

    public function getTotalPaie(): ?int
    {
        return $this->totalPaie;
    }

    public function setTotalPaie(?int $totalPaie): self
    {
        $this->totalPaie = $totalPaie;

        return $this;
    }

    public function getBranch(): ?string
    {
        return $this->branch;
    }

    public function setBranch(string $branch): self
    {
        $this->branch = $branch;

        return $this;
    }

    /**
     * @return Collection|Commandes[]
     */
    public function getPaiment(): Collection
    {
        return $this->paiment;
    }


}

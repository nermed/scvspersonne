<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ServicesRepository;
use DateTime;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\DateTimeImmutableType;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ServicesRepository::class)
 */
#[ApiResource(  normalizationContext: ['groups'=>'read:collectionService'], 
                attributes: ["pagination_items_per_page" => 10,
                            "pagination_client_enabled" => true,
                            "pagination_enabled"=> true
                            ]
                )]
class Services
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(['read:collectionService', 'read:detail'])]
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(['read:collectionService', 'read:detail'])]
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    #[Groups(['read:collectionService', 'read:detail'])]
    private $description;

    /**
     * @ORM\Column(type="float")
     */
    #[Groups(['read:collectionService'])]
    private $price_initial;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    #[Groups(['read:collectionService'])]
    private $price_special;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $modify_at;

    /**
     * @ORM\Column(type="integer")
     */
    private $created_by;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $modified_by;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $deleted_by;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $deleted_status;

    /**
     * @ORM\Column(type="integer")
     */
    #[Groups(['read:collectionService'])]
    private $quantity_max;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(['read:collectionService'])]
    private $code_service;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    #[Groups(['read:collectionService'])]
    private $duree;

    /**
     * @ORM\ManyToMany(targetEntity=Commandes::class, mappedBy="services")
     */
    private $commandes;

    public function __construct()
    {
        $this->created_at = new DateTimeImmutable();
        $this->created_by = 1;
        $this->code_service = '214';
        $this->commandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPriceInitial(): ?float
    {
        return $this->price_initial;
    }

    public function setPriceInitial(float $price_initial): self
    {
        $this->price_initial = $price_initial;

        return $this;
    }

    public function getPriceSpecial(): ?float
    {
        return $this->price_special;
    }

    public function setPriceSpecial(?float $price_special): self
    {
        $this->price_special = $price_special;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getModifyAt(): ?\DateTimeImmutable
    {
        return $this->modify_at;
    }

    public function setModifyAt(?\DateTimeImmutable $modify_at): self
    {
        $this->modify_at = $modify_at;

        return $this;
    }

    public function getCreatedBy(): ?int
    {
        return $this->created_by;
    }

    public function setCreatedBy(int $created_by): self
    {
        $this->created_by = $created_by;

        return $this;
    }

    public function getModifiedBy(): ?int
    {
        return $this->modified_by;
    }

    public function setModifiedBy(?int $modified_by): self
    {
        $this->modified_by = $modified_by;

        return $this;
    }

    public function getDeletedBy(): ?int
    {
        return $this->deleted_by;
    }

    public function setDeletedBy(?int $deleted_by): self
    {
        $this->deleted_by = $deleted_by;

        return $this;
    }

    public function getDeletedStatus(): ?int
    {
        return $this->deleted_status;
    }

    public function setDeletedStatus(?int $deleted_status): self
    {
        $this->deleted_status = $deleted_status;

        return $this;
    }

    public function getQuantityMax(): ?int
    {
        return $this->quantity_max;
    }

    public function setQuantityMax(int $quantity_max): self
    {
        $this->quantity_max = $quantity_max;

        return $this;
    }

    public function getCodeService(): ?string
    {
        return $this->code_service;
    }

    public function setCodeService(string $code_service): self
    {
        $this->code_service = $code_service;

        return $this;
    }

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(?int $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    /**
     * @return Collection|Commandes[]
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commandes $commande): self
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes[] = $commande;
            $commande->addService($this);
        }

        return $this;
    }

    public function removeCommande(Commandes $commande): self
    {
        if ($this->commandes->removeElement($commande)) {
            $commande->removeService($this);
        }

        return $this;
    }
}

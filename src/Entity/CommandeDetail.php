<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\Components\Api\CommandesDetailController;
use App\Repository\CommandeDetailRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=CommandeDetailRepository::class)
 */
#[ApiResource(forceEager: false,
    collectionOperations: [
        'get',
        'post' => [
            'denormalization_context' => ['groups'=> ['post:CommandeDetail']],
            'controller' => CommandesDetailController::class
        ]
    ],
    itemOperations: [
        'get' =>  [
            'normalization_context' => ['groups'=> ['read:CDcollection', 'read:CDdetail']]
        ],
        'put' => [
            'denormalization_context' => ['groups'=> ['put:Commande']]
        ]
    ]
)]
class CommandeDetail
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Commandes::class, inversedBy="commandeDetails")
     * @ORM\JoinColumn(nullable=false)
     */
    #[Groups(['read:CDdetail'])]
    private $commandes;

    /**
     * @ORM\ManyToOne(targetEntity=Services::class, inversedBy="commandeServices")
     * @ORM\JoinColumn(nullable=false)
     */
    #[Groups(['read:CDdetail','post:CommandeDetail'])]
    private $services;

    /**
     * @ORM\Column(type="integer")
     */
    #[Groups(['read:CDdetail','post:CommandeDetail'])]
    private $hours;

    /**
     * @ORM\Column(type="integer")
     */
    #[Groups(['read:CDdetail','post:CommandeDetail'])]
    private $price;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    #[Groups(['read:CDdetail'])]
    private $com_createdAt;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    #[Groups(['read:CDdetail','post:CommandeDetail'])]
    private $validite;

    public function __construct()
    {
        $this->com_createdAt = new DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCommandes(): ?Commandes
    {
        return $this->commandes;
    }

    public function setCommandes(?Commandes $commandes): self
    {
        $this->commandes = $commandes;

        return $this;
    }

    public function getServices(): ?Services
    {
        return $this->services;
    }

    public function setServices(?Services $services): self
    {
        $this->services = $services;

        return $this;
    }

    public function getHours(): ?int
    {
        return $this->hours;
    }

    public function setHours(int $hours): self
    {
        $this->hours = $hours;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }
    public function getComCreatedAt(): ?\DateTimeImmutable
    {
        return $this->com_createdAt;
    }

    public function setComCreatedAt(\DateTimeImmutable $com_createdAt): self
    {
        $this->com_createdAt = $com_createdAt;

        return $this;
    }

    public function getValidite(): ?int
    {
        return $this->validite;
    }

    public function setValidite(?int $validite): self
    {
        $this->validite = $validite;

        return $this;
    }
}

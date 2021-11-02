<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CommandesRepository;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=CommandesRepository::class)
 */
#[ApiResource(  forceEager: false,
                collectionOperations: ['get', 'post' => [
                    'denormalization_context' => ['groups'=> ['post:Commande']]
                ]
                    ],
                itemOperations: ['get' =>  [
                  'normalization_context' => ['groups'=> ['read:collection', 'read:detail']]
                  ]
                , 'put' => [
                    'denormalization_context' => ['groups'=> ['put:Commande']]
                    ]],
    )]
class Commandes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(['read:collection'])]
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    #[Groups(['read:collection'])]
    private $code_commande;

    /**
     * @ORM\ManyToMany(targetEntity=Services::class, inversedBy="commandes")
     */
    #[Groups(['read:detail','post:Commande', 'put:Commande'])]
    private $services;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    #[Groups(['read:collection'])]
    private $com_createdAt;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    #[Groups(['read:collection','post:Commande', 'put:Commande'])]
    private $duree;

    public function __construct()
    {
        $this->com_createdAt = new DateTimeImmutable();
        $this->services = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeCommande(): ?string
    {
        return $this->code_commande;
    }

    public function setCodeCommande(?string $code_commande): self
    {
        $this->code_commande = $code_commande;

        return $this;
    }

    /**
     * @return Collection|Services[]
     */
    public function getServices(): Collection
    {
        return $this->services;
    }

    public function addService(Services $service): self
    {
        if (!$this->services->contains($service)) {
            $this->services[] = $service;
        }

        return $this;
    }

    public function removeService(Services $service): self
    {
        $this->services->removeElement($service);

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

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(?int $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

}

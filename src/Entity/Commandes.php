<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\Components\Api\CommandesController;
use App\Repository\CommandesRepository;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=CommandesRepository::class)
 */
#[ApiResource(  
                collectionOperations: ['get',
                'post' => [
                    // 'security' => "is_granted('IS_AUTHENTICATED_FULLY')",
                    'denormalization_context' => ['groups'=> ['post:Commande']],
                    'controller' => CommandesController::class
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
    // #[Groups(['read:collection', 'read:detail'])]
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    #[Groups(['read:collection', 'read:Pdetail', 'read:detail', 'read:Pcollection'])]
    private $code_commande;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    #[Groups(['read:collection', 'read:detail'])]
    private $com_createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=UserClient::class, inversedBy="commandes")
     */
    #[Groups(['read:collection','post:Commande'])]
    private $author;

    /**
     * @ORM\OneToMany(targetEntity=CommandeDetail::class, mappedBy="commandes")
     */
    #[Groups(['read:collection'])]
    private $commandeDetails;


    public function __construct()
    {
        $this->com_createdAt = new DateTimeImmutable();
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

    public function getComCreatedAt(): ?\DateTimeImmutable
    {
        return $this->com_createdAt;
    }

    public function setComCreatedAt(\DateTimeImmutable $com_createdAt): self
    {
        $this->com_createdAt = $com_createdAt;

        return $this;
    }

    public function getAuthor(): ?UserClient
    {
        return $this->author;
    }

    public function setAuthor(?UserClient $author): self
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return Collection|CommandeDetail[]
     */
    public function getCommandeDetails(): Collection
    {
        return $this->commandeDetails;
    }

    public function addCommandeDetail(CommandeDetail $commandeDetail): self
    {
        if (!$this->commandeDetails->contains($commandeDetail)) {
            $this->commandeDetails[] = $commandeDetail;
            $commandeDetail->setCommandes($this);
        }

        return $this;
    }

    public function removeCommandeDetail(CommandeDetail $commandeDetail): self
    {
        if ($this->commandeDetails->removeElement($commandeDetail)) {
            // set the owning side to null (unless already changed)
            if ($commandeDetail->getCommandes() === $this) {
                $commandeDetail->setCommandes(null);
            }
        }

        return $this;
    }


}

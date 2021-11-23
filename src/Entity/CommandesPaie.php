<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\Components\Api\PaimentController;
use App\Repository\CommandesPaieRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=CommandesPaieRepository::class)
 */
#[ApiResource(
    collectionOperations: [
        'get',
        'post' => [
            'denormalization_context' => ['groups'=> ['post:commandesPaie']],
            'controller' => PaimentController::class
        ]
    ],
    itemOperations: [
        'get' =>  [
            'normalization_context' => ['groups'=> ['read:Pcollection', 'read:Pdetail']]
        ],
        'put' => [
            'denormalization_context' => ['groups'=> ['put:Commande']]
        ]
    ]
)]
class CommandesPaie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    #[Groups(['post:commandesPaie'])]
    private $montantPaie;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(['post:commandesPaie'])]
    private $code;

    /**
     * @ORM\Column(type="integer")
     */
    #[Groups(['post:commandesPaie'])]
    private $commandesid;

    /**
     * @ORM\Column(type="string", length=100)
     */
    #[Groups(['post:commandesPaie'])]
    private $branch;

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

    public function getMontantPaie(): ?int
    {
        return $this->montantPaie;
    }

    public function setMontantPaie(int $montantPaie): self
    {
        $this->montantPaie = $montantPaie;

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


    public function getCommandesid(): ?int
    {
        return $this->commandesid;
    }

    public function setCommandesid(int $commandesid): self
    {
        $this->commandesid = $commandesid;

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
}

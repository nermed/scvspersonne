<?php

namespace App\Entity;

use App\Repository\RoleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RoleRepository::class)
 */
class Role
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
    private $name;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $roleName;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status;

    /**
     * @ORM\ManyToMany(targetEntity=UserClient::class, mappedBy="role")
     */
    private $userClients;

    public function __construct()
    {
        $this->userClients = new ArrayCollection();
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

    public function getRoleName(): ?string
    {
        return $this->roleName;
    }

    public function setRoleName(string $roleName): self
    {
        $this->roleName = $roleName;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection|UserClient[]
     */
    public function getUserClients(): Collection
    {
        return $this->userClients;
    }

    public function addUserClient(UserClient $userClient): self
    {
        if (!$this->userClients->contains($userClient)) {
            $this->userClients[] = $userClient;
            $userClient->addRole($this);
        }

        return $this;
    }

    public function removeUserClient(UserClient $userClient): self
    {
        if ($this->userClients->removeElement($userClient)) {
            $userClient->removeRole($this);
        }

        return $this;
    }
}

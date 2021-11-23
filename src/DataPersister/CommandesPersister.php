<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\CommandeDetail;
use App\Repository\CommandesRepository;
use Doctrine\ORM\EntityManagerInterface;

class CommandesPersister implements ContextAwareDataPersisterInterface
{

    private $entity;
    private $commande;

    public function __construct(EntityManagerInterface $manager, CommandesRepository $commande)
    {
        $this->entity = $manager;
        $this->commande = $commande;
    }
    /**
     * Is the data supported by the persister?
     */
    public function supports($data, $context = []): bool
    {
        return $data instanceof CommandeDetail;
    }

    /**
     * Persists the data.
     *
     * @return object|void Void will not be supported in API Platform 3, an object should always be returned
     */
    public function persist($data, array $context = []){
        // dd($data);
        $this->entity->persist($data);
        $this->entity->flush();
    }

    /**
     * Removes the data.
     */
    public function remove($data, array $context = []){

    }
}
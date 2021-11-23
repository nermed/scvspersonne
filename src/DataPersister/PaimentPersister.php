<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\CommandesPaie;
use App\Repository\PaimentRepository;
use Doctrine\ORM\EntityManagerInterface;

class PaimentPersister implements ContextAwareDataPersisterInterface
{

    private $entity;
    private $paimentRepository;

    public function __construct(EntityManagerInterface $manager, PaimentRepository $paimentRepository)
    {
        $this->entity = $manager;
        $this->paimentRepository = $paimentRepository;
    }
    /**
     * Is the data supported by the persister?
     */
    public function supports($data, $context = []): bool
    {
        return $data instanceof CommandesPaie;
    }

    /**
     * Persists the data.
     *
     * @return object|void Void will not be supported in API Platform 3, an object should always be returned
     */
    public function persist($data, array $context = []){
        $this->entity->persist($data);
        $this->entity->flush();
    }

    /**
     * Removes the data.
     */
    public function remove($data, array $context = []){

    }
}
<?php

namespace App\Controller\Components\Api;

use App\Entity\Commandes;
use App\Repository\CommandesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Security\Core\Security;

#[AsController]
class CommandesController extends AbstractController
{

    private $security;
    private $codeCommande;

    public function __construct(Security $security, CommandesRepository $codeCommande)
    {
        $this->security = $security;
        $this->codeCommande = $codeCommande;
    }
    public function __invoke($data)
    {
        $data->setAuthor($this->security->getUser())
        ->setCodeCommande($this->codeCommande->random_code());
        return $data;
    }
}
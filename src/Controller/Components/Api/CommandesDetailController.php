<?php

namespace App\Controller\Components\Api;

use App\Entity\CommandeDetail;
use App\Entity\Commandes;
use App\Repository\CommandesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Security\Core\Security;

#[AsController]
class CommandesDetailController extends AbstractController
{

    private $security;
    private $commande;

    public function __construct(Security $security, CommandesRepository $commande)
    {
        $this->security = $security;
        $this->commande = $commande;
    }
    public function __invoke(CommandeDetail $data)
    {
        $commandes = $this->commande->select_last();

        foreach($commandes as $commande) {
            $data->setCommandes($commande);   
        }
        return $data;
    }
}
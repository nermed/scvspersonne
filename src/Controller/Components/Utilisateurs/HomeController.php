<?php

namespace App\Controller\Components\Utilisateurs;

use App\Entity\Services;
use App\Repository\EmployeeRepository;
use App\Repository\ServicesRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/')]
class HomeController extends AbstractController
{
    #[Route('/', name: 'home', methods: ['GET'])]
    public function index(ServicesRepository $services): Response
    {
        $servicesLatest = $services->findLatest();

        return $this->render('users/home/index.html.twig', [
            'servicesLatest' => $servicesLatest,
        ]);
    }

    #[Route('/services', name: 'services', methods: ['GET'])]
    public function servicesList(ServicesRepository $services, PaginatorInterface $paginator, Request $request): Response
    {
        $servicesList = $paginator->paginate(
            $services->findAllQueryP(),
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('users/services/index.html.twig', [
            'servicesList' => $servicesList,
        ]);
    }
}
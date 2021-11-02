<?php

namespace App\Controller;

use App\Entity\Services;
use App\Form\ServicesType;
use App\Repository\ServicesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ServiceController extends AbstractController
{
    private $services;

    public function __construct(ServicesRepository $service)
    {
        $this->services = $service;
    }

    #[Route('/service', name: 'service')]
    public function index(): Response
    {
        $services = $this->services->findAll();
        return $this->render('service/index.html.twig', [
            'controller_name' => 'ServiceController',
            'services' => $services
        ]);
    }

    #[Route('/service/nouveau', name: 'service_nouveau', methods:'GET|POST')]
    /*
    * @return \Symfony\Component\HttpFoundation\Response
    */
    public function nouveau(Request $request)
    {
        $service = new Services();
        $form = $this->createForm(ServicesType::class, $service);
        if($form->handleRequest($request)->isSubmitted()) {
            if($form->isValid()) {

            }
        }
    }
}

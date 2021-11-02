<?php

namespace App\Controller\Components\Admin;

use App\Entity\Services;
use App\Form\ServicesType;
use App\Repository\ServicesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/adminPath/services')]
class ServicesController extends AbstractController
{
    #[Route('/', name: 'adminPath.services', methods: ['GET'])]
    public function index(ServicesRepository $servicesRepository): Response
    {
        return $this->render('admin/services/index.html.twig', [
            'services' => $servicesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'adminPath.services_new', methods: ['GET','POST'])]
    public function new(Request $request): Response
    {
        $service = new Services();
        $form = $this->createForm(ServicesType::class, $service);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($service);
            $entityManager->flush();

            return $this->redirectToRoute('adminPath.services', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/services/new.html.twig', [
            'service' => $service,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'adminPath.services_show', methods: ['GET'])]
    public function show(Services $service): Response
    {
        return $this->render('admin/services/show.html.twig', [
            'service' => $service,
        ]);
    }

    #[Route('/{id}/edit', name: 'adminPath.services_edit', methods: ['GET','POST'])]
    public function edit(Request $request, Services $service): Response
    {
        $form = $this->createForm(ServicesType::class, $service);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('adminPath.services', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/services/edit.html.twig', [
            'service' => $service,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'adminPath.services_delete', methods: ['POST'])]
    public function delete(Request $request, Services $service): Response
    {
        if ($this->isCsrfTokenValid('delete'.$service->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($service);
            $entityManager->flush();
        }

        return $this->redirectToRoute('adminPath.services', [], Response::HTTP_SEE_OTHER);
    }
}

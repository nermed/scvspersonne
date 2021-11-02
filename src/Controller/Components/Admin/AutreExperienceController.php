<?php

namespace App\Controller\Components\Admin;

use App\Entity\AutreExperience;
use App\Form\AutreExperienceType;
use App\Repository\AutreExperienceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/autre/experience')]
class AutreExperienceController extends AbstractController
{
    #[Route('/', name: 'autre_experience_index', methods: ['GET'])]
    public function index(AutreExperienceRepository $autreExperienceRepository): Response
    {
        return $this->render('autre_experience/index.html.twig', [
            'autre_experiences' => $autreExperienceRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'autre_experience_new', methods: ['GET','POST'])]
    public function new(Request $request): Response
    {
        $autreExperience = new AutreExperience();
        $form = $this->createForm(AutreExperienceType::class, $autreExperience);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($autreExperience);
            $entityManager->flush();

            return $this->redirectToRoute('autre_experience_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('autre_experience/new.html.twig', [
            'autre_experience' => $autreExperience,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'autre_experience_show', methods: ['GET'])]
    public function show(AutreExperience $autreExperience): Response
    {
        return $this->render('autre_experience/show.html.twig', [
            'autre_experience' => $autreExperience,
        ]);
    }

    #[Route('/{id}/edit', name: 'autre_experience_edit', methods: ['GET','POST'])]
    public function edit(Request $request, AutreExperience $autreExperience): Response
    {
        $form = $this->createForm(AutreExperienceType::class, $autreExperience);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('autre_experience_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('autre_experience/edit.html.twig', [
            'autre_experience' => $autreExperience,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'autre_experience_delete', methods: ['POST'])]
    public function delete(Request $request, AutreExperience $autreExperience): Response
    {
        if ($this->isCsrfTokenValid('delete'.$autreExperience->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($autreExperience);
            $entityManager->flush();
        }

        return $this->redirectToRoute('autre_experience_index', [], Response::HTTP_SEE_OTHER);
    }
}

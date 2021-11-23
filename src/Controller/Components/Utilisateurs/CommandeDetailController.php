<?php

namespace App\Controller\Components\Utilisateurs;

use App\Entity\CommandeDetail;
use App\Entity\Commandes;
use App\Form\CommandeDetailType;
use App\Repository\CommandeDetailRepository;
use App\Repository\CommandesPaieRepository;
use App\Repository\CommandesRepository;
use DateTime;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/commande/detail')]
#[IsGranted('IS_AUTHENTICATED_FULLY')]
class CommandeDetailController extends AbstractController
{
    #[Route('/', name: 'commande_detail_index', methods: ['GET'])]
    public function index(CommandeDetailRepository $commandeDetailRepository): Response
    {
        $user = $this->getUser()->getId();
        $commandeDetail = $commandeDetailRepository->collectCommand($user);
        // dd($commandeDetail);
        return $this->render('users/commande_detail/index.html.twig', [
            'commande_details' => $commandeDetail,
        ]);
    }

    #[Route('/new', name: 'commande_detail_new', methods: ['GET','POST'])]
    public function new(Request $request): Response
    {
        $commandeDetail = new CommandeDetail();
        $form = $this->createForm(CommandeDetailType::class, $commandeDetail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($commandeDetail);
            $entityManager->flush();

            return $this->redirectToRoute('commande_detail_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('commande_detail/new.html.twig', [
            'commande_detail' => $commandeDetail,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'commande_detail_show', methods: ['GET'])]
    public function show(Commandes $commande, CommandesRepository $commandesRepository, CommandeDetailRepository $commandeDetailRepository, CommandesPaieRepository $commandesPaieRepository): Response
    {
        $commandeDetail = $commandesRepository->collectDetail($commande->getId());
        foreach ($commandeDetail as $key => $val) {
            // $date = new DateTime($val['com_created_at']);
            // $date->modify('+'.$val['validite'].' days');
            // $val['date'] = $date->format('d-m-Y');
            $val['validite'] = intval($val['validite']);
        }
        // dd($commandeDetail);die;
        $paie = $commandesPaieRepository->commandPaie($commande->getId());
        $employee_free = $commandeDetailRepository->collectEmployee();
        $employeeTaken = $commandeDetailRepository->employeeTaken($commande->getId());
        // dd($commande->getId());
        return $this->render('users/commande_detail/show.html.twig', [
            'commande' => $commande,
            'commande_detailss' => $commandeDetail,
            'paie' => $paie,
            'employee_free' => $employee_free,
            'employeeTaken' => $employeeTaken
        ]);
    }

    #[Route('/{id}/edit', name: 'commande_detail_edit', methods: ['GET','POST'])]
    public function edit(Request $request, CommandeDetail $commandeDetail): Response
    {
        $form = $this->createForm(CommandeDetailType::class, $commandeDetail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('commande_detail_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('users/commande_detail/edit.html.twig', [
            'commande_detail' => $commandeDetail,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'commande_detail_delete', methods: ['POST'])]
    public function delete(Request $request, CommandeDetail $commandeDetail): Response
    {
        if ($this->isCsrfTokenValid('delete'.$commandeDetail->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($commandeDetail);
            $entityManager->flush();
        }

        return $this->redirectToRoute('commande_detail_index', [], Response::HTTP_SEE_OTHER);
    }

    // #[Route('/employee', name: 'commande_detail_employee', methods: ['POST'])]
    // public function addEmployee()
    // {
    //     $comm = $this->input->post('commande');

    //     echo json_encode($comm);
    // }
}

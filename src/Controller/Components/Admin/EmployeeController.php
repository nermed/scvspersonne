<?php

namespace App\Controller\Components\Admin;

use App\Entity\AutreExperience;
use App\Entity\Employee;
use App\Form\AutreExperienceType;
use App\Form\EmployeeType;
use App\Repository\EmployeeRepository;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/adminPath/employee')]
class EmployeeController extends AbstractController
{
    #[Route('/', name: 'adminPath.employee_index', methods: ['GET'])]
    public function index(EmployeeRepository $employeeRepository): Response
    {
        return $this->render('admin/employee/index.html.twig', [
            'employees' => $employeeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'adminPath.employee_new', methods: ['GET','POST'])]
    public function new(Request $request, FileUploader $fileUploader): Response
    {
        $employee = new Employee();
        $form = $this->createForm(EmployeeType::class, $employee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $employee->getImageFile();
            $fileName = $fileUploader->upload($file);
            $employee->setImgPath($fileName);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($employee);
            $entityManager->flush();

            return $this->redirectToRoute('adminPath.employee_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/employee/new.html.twig', [
            'employee' => $employee,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'adminPath.employee_show', methods: ['GET'])]
    public function show(Employee $employee): Response
    {
        return $this->render('admin/employee/show.html.twig', [
            'employee' => $employee,
        ]);
    }

    #[Route('/{id}/edit', name: 'adminPath.employee_edit', methods: ['GET','POST'])]
    public function edit(Request $request, Employee $employee, FileUploader $fileUploader): Response
    {
        $form = $this->createForm(EmployeeType::class, $employee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $employee->getImageFile();
            $fileName = $fileUploader->upload($file);
            if($employee->getImgPath() != $fileName) {
                $employee->setImgPath($fileName);
            }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('adminPath.employee_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/employee/edit.html.twig', [
            'employee' => $employee,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'adminPath.employee_delete', methods: ['POST'])]
    public function delete(Request $request, Employee $employee): Response
    {
        if ($this->isCsrfTokenValid('delete'.$employee->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($employee);
            $entityManager->flush();
        }

        return $this->redirectToRoute('adminPath.employee_index', [], Response::HTTP_SEE_OTHER);
    }
}

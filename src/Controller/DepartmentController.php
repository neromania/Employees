<?php

namespace App\Controller;

use App\Entity\Department;
use App\Form\DepartmentType;
use App\Repository\DepartmentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/department')]
class DepartmentController extends AbstractController
{
    #[Route('/', name: 'app_department_index', methods: ['GET'])]
    public function index(DepartmentRepository $departmentRepository): Response
    {
        
        return $this->render('department/index.html.twig', [
            'departments' => $departmentRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_department_new', methods: ['GET', 'POST'])]
    public function new(Request $request, DepartmentRepository $departmentRepository): Response
    {
        $department = new Department();
        $form = $this->createForm(DepartmentType::class, $department);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $departmentRepository->save($department, true);

            return $this->redirectToRoute('app_department_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('department/new.html.twig', [
            'department' => $department,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_department_show', methods: ['GET'])]
    public function show(Department $department): Response
    {
        $managers = $department->getManager();
        $actualManager = null;
        
        $employees = $department->getEmployees();
        $actualTeam = [];
        foreach ($employees as $employee) {
            $teamates = $employee->getEmployeeHistory();
            foreach ($teamates as $empl) {
                if ($empl->getToDate()->format('Y')=="9999" ) {
                $actualTeam[] = $employee;
                }
            }
        }
        foreach ($managers as $manager) {
           $managings = $manager->getManagerHistory();
           foreach ($managings as $managing) {
                if ($managing->getToDate()->format('Y')=="9999" ) {
                    $actualManager = $manager;
                }
           }
        }
        return $this->render('department/show.html.twig', [
            'department' => $department,
            'manager' => $actualManager,
            'employees' => $actualTeam
        ]);
    }

    #[Route('/{id}/edit', name: 'app_department_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Department $department, DepartmentRepository $departmentRepository): Response
    {
        $form = $this->createForm(DepartmentType::class, $department);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $departmentRepository->save($department, true);

            return $this->redirectToRoute('app_department_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('department/edit.html.twig', [
            'department' => $department,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_department_delete', methods: ['POST'])]
    public function delete(Request $request, Department $department, DepartmentRepository $departmentRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$department->getId(), $request->request->get('_token'))) {
            $departmentRepository->remove($department, true);
        }

        return $this->redirectToRoute('app_department_index', [], Response::HTTP_SEE_OTHER);
    }
}

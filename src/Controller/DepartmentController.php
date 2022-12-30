<?php

namespace App\Controller;

use App\Entity\Departement;
use App\Repository\DepartementRepository;
use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DepartmentController extends AbstractController
{
    #[Route('/department', name: 'department.index', methods: ['GET'])]
    public function index( DepartementRepository $repository): Response
    {
        $department = $repository->findAll();

        //dd($departements);
        return $this->render('department/index.html.twig', [
            'departments' => $department,
        ]);
    }

    #[Route('/department/show/{deptNo}', 'department.show', methods:['GET'])]
    public function show(DepartementRepository $repository) : Response
    {
        $department = $repository->find('deptNo');

        return $this->render('department/show.html.twig', [
            'department' => $department,
        ]);
    }



}

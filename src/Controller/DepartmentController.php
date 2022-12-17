<?php

namespace App\Controller;

use App\Repository\DepartementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DepartmentController extends AbstractController
{
    #[Route('/department', name: 'department.index', methods: ['GET'])]
    public function index( DepartementRepository $repository): Response
    {
        $departements = $repository->findAll();
        dd($departements);

        return $this->render('department/index.html.twig', [
            'controller_name' => 'DepartmentController',
        ]);
    }
}

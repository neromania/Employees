<?php

namespace App\Controller;

use App\Repository\DepartmentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DepartmentController extends AbstractController
{
    #[Route('/department', name: 'app_department')]
    public function index(DepartmentRepository $repo): Response
    {
        
        return $this->render('department/index.html.twig', [
            'controller_name' => 'DepartmentController',
            'departments' => $repo->findAll(),

        ]);
    }
}

<?php

namespace App\Controller;

use App\Entity\Employee;
use App\Repository\EmployeeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;

class WomenController extends AbstractController
{
    /*#[Route('/women', name: 'app_women')]
    public function index(Connection $connection)
    {
        $query = "SELECT * FROM employees WHERE gender = 'F'";
        $stmt = $connection->prepare($query);
        $stmt->executeQuery();
        $employees = $stmt/*->fetchAllAssociative();
        return $this->render('employee/index.html.twig', [
            'employees' => $employees,
        ]);
    }*/
        
    #[Route('/women', name: 'app_employee_women', methods: ['GET'])]
    public function women(EmployeeRepository $repo) : Response
    {
        $all = $repo->findAll();
        $womens = $repo->findBy(['gender'=>'F']); 
        $mens = $repo->findBy(['gender'=>'M']);
        $other = $repo->findBy(['gender'=>'X']);
        foreach ($all as $one) {
           $dept[] = $one->getDepartments();
        }
        return $this->render('women/index.html.twig', [
            'womens' => $womens,
            'mens' => $mens,
            'other' => $other,
            'department' => $dept

        ]);
    }

    /*public function findWomen(EmployeeRepository $employeeRepository): Response
    {
        $conn = DriverManager::getConnection($params, $config);

        $sql = '
            SELECT * FROM employees
            WHERE gender = F
            ';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    }*/
    /*#[Route('/all', name: 'app_women_all')]
    private $doctrine;
    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }
    public function onlyWomen(): array
    {
        $conn = $this->getEmployeeEntity()->getConnection();

        $sql = '
            SELECT * FROM product p
            WHERE p.price > :price
            ORDER BY p.price ASC
            ';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery(['price' => $price]);

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    }
    {
        $em = $this->doctrine->getManager();
        $query = $em->createQueryBuilder()
            ->select('e')
            ->from('App:Employee', 'e')
            ->where('e.gender = :gender')
            ->setParameter('gender', 'F')
            ->getQuery();
        $employees = $query->getResult();
        return $this->render('employee/index.html.twig', [
            'employees' => $employees,
        ]);
    }*/
}

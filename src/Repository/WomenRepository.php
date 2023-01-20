<?php

namespace App\Repository;

use App\Entity\Employee;
use App\Entity\WomenController;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<WomenController>
 *
 * @method WomenController|null find($id, $lockMode = null, $lockVersion = null)
 * @method WomenController|null findOneBy(array $criteria, array $orderBy = null)
 * @method WomenController[]    findAll()
 * @method WomenController[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WomenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WomenController::class);
    }

    public function save(WomenController $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(WomenController $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

     /**
     * @throws Exception
     */
    public function findByGender(): array
    {

        $conn = $this->getEntityManager()->getConnection();

        $sql = "select gender
                , count( case when gender='M'
                then 1 end ) as Male
                , count( case when gender='F'
                then 1 end ) as Female
                , count( case when gender='X'
                then 1 end ) as Undefined
                FROM employees e GROUP BY gender
                INNER JOIN dept_emp de ON d.emp_no=de.emp_no
                    WHERE de.to_date='9999-01-01'";

        //dd($resultSet->fetchOne());
        return $conn->executeQuery($sql)->fetchAllAssociative();
        // returns an array of arrays (i.e. a raw data set)

    }

//    /**
//     * @return WomenController[] Returns an array of WomenController objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('w')
//            ->andWhere('w.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('w.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?WomenController
//    {
//        return $this->createQueryBuilder('w')
//            ->andWhere('w.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

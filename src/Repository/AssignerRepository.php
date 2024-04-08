<?php

namespace App\Repository;

use App\Entity\Assigner;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Assigner>
 *
 * @method Assigner|null find($id, $lockMode = null, $lockVersion = null)
 * @method Assigner|null findOneBy(array $criteria, array $orderBy = null)
 * @method Assigner[]    findAll()
 * @method Assigner[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AssignerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Assigner::class);
    }

    //    /**
    //     * @return Assigner[] Returns an array of Assigner objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('a.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Assigner
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}

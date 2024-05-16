<?php

namespace App\Repository;

use App\Entity\Associer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Produit;
use App\Repository\ProduitRepository;

/**
 * @extends ServiceEntityRepository<Associer>
 *
 * @method Associer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Associer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Associer[]    findAll()
 * @method Associer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AssocierRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Associer::class);
    }

    public function findByProduit(Produit $produit): array
    {
    return $this->createQueryBuilder('a')
        ->andWhere('a.produit = :produit')
        ->setParameter('produit', $produit)
        ->getQuery()
        ->getResult();
    }
    public function findByProduitAndTaille($produitId, $taille)
    {
    return $this->createQueryBuilder('a')
        ->andWhere('a.produit = :produitId')
        ->andWhere('a.taille = :taille')
        ->setParameter('produitId', $produitId)
        ->setParameter('taille', $taille)
        ->getQuery()
        ->getOneOrNullResult();
    }


    //    /**
    //     * @return Associer[] Returns an array of Associer objects
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

    //    public function findOneBySomeField($value): ?Associer
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}

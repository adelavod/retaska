<?php

namespace App\Repository;

use App\Entity\Objednani;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Objednani|null find($id, $lockMode = null, $lockVersion = null)
 * @method Objednani|null findOneBy(array $criteria, array $orderBy = null)
 * @method Objednani[]    findAll()
 * @method Objednani[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ObjednaniRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Objednani::class);
    }

    // /**
    //  * @return Objednani[] Returns an array of Objednani objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Objednani
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

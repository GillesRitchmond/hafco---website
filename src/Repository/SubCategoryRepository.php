<?php

namespace App\Repository;

use App\Entity\SubCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SubCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method SubCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method SubCategory[]    findAll()
 * @method SubCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SubCategory::class);
    }

    /**
     * @return SubCategory[]
     */

    public function findAllCategories(): array
    {
        return $this->createQueryBuilder('p')
            ->where('p.productPrice = 2000')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return Query
     */
    public function findAllVisibleQuery(): Query
    {
        return $this->createQueryBuilder('p')
            ->getQuery();
    }


    /**
     * @return SubCategory[]
     */

    public function findLatest(): array
    {
        return $this->createQueryBuilder('p')
        ->setMaxResults(20)
        ->getQuery()
        ->getResult();
    }

    /**
     * @return SubCategory[]
     */

    public function findAll(): array
    {
        return $this->findBy(array(), array('SubCategoryName' => 'ASC'));
    }

    // /**
    //  * @return SubCategory[] Returns an array of SubCategory objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SubCategory
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

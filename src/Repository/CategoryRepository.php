<?php

namespace App\Repository;

use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }

    /**
     * @return Category[]
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
     * @return Category[]
     */

    public function findLatest(): array
    {
        return $this->createQueryBuilder('p')
        ->setMaxResults(10)
        ->getQuery()
        ->getResult();
    }

    /**
     * @return Category[]
     */

    public function findAll(): array
    {
        return $this->findBy(array(), array('CategoryName' => 'ASC'));
    }

    // /**
    //  * @return Product[] Returns an array of Product objects
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
    public function findOneBySomeField($value): ?Product
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

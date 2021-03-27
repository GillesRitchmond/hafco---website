<?php

namespace App\Repository;

use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Category|null find($id, $lockMode = null, $lockVersion = null)
 * @method Category|null findOneBy(array $criteria, array $orderBy = null)
 * @method Category[]    findAll()
 * @method Category[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
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
            ->where('p.productPrice > 0')
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


//     public function findOneByCategory($id)
//     {
//     $query = $this->createQueryBuilder('p');

//         $query->select('p.productName, p.productDescription')
//             ->from('category', 'product')
//             ->where('category.id = :id AND product.categories_id = :id')
//             ->setParameter('id', $id);

//         // echo $query->getSQL(); => Doesn't work... 

//         return $query->getQuery()->getSql();
    
//     // return $this->createQueryBuilder('p')
//     //         ->andWhere('p.exampleField = :val')
//     //         ->setParameter('val', $value)
//     //         ->orderBy('p.id', 'ASC')
//     //         ->setMaxResults(10)
//     //         ->getQuery()
//     //         ->getResult()
//     //     ;
// }


    // /**
    //  * @return Category[] Returns an array of Category objects
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
    public function findOneBySomeField($value): ?Category
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

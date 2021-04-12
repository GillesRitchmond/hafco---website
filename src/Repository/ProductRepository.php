<?php

namespace App\Repository;

use App\Entity\Category;
use App\Entity\Product;
use App\Entity\ProductByCategory;
use App\Entity\ProductSearch;
use App\Form\ProductByCategoryForm;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\Migrations\Query\Query as QueryQuery;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\QueryBuilder as ORMQueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    /**
     * @return Product[]
     */

    public function findAllProducts(): array
    {
        return $this->createQueryBuilder('p')
            ->where('p.productPrice >= 0')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Query
     */
    public function findTheVisibleQuery(ProductSearch $search): Query
    {
        
        $query = $this->findVisibleQuery();

        if($search->getProductName()){
            $query = $query
                ->where('p.productName LIKE :name')
                ->setParameter('name', '%'.$search->getProductName().'%');
        }
        return $query->getQuery();
    }

    /**
     * Pour récupérer les produits avec une recherche
     * @return Query
     */
    public function findAllVisibleQuery(ProductSearch $search): Query
    {
        
        $query = $this
            ->createQueryBuilder('p')
            ->select('p')
            // ->innerJoin('p.categories', 'c')
            ;
        
            // if(!empty($search->getProductName()) AND !empty($search->getCategories())){
            // $query = $query
            //     ->where('p.productName LIKE :name')
            //     ->andWhere('p.categories = :categories')
            //     ->setParameter('name', '%'.$search->getProductName().'%')
            //     ->setParameter('categories', $search->getCategories());
            // }

        if(!empty($search->getProductName())){
            $query = $query
                ->where('p.productName LIKE :name')
                ->setParameter('name', '%'.$search->getProductName().'%');
        }

        // if(!empty($search->getCategories())){
        //     $query = $query 
        //         ->andWhere('p.categories IN (:categories)')
        //         ->setParameter('categories', $search->getCategories());
        // }

       return $query->getQuery();
    }


    /**
     * @return Product[]
     */

    public function findLatest(): array
    {
        return $this->createQueryBuilder('p')
        ->setMaxResults(12)
        ->getQuery()
        ->getResult();
    }

    /**
     * @return Product[]
     */

    public function findAll(): array
    {
        return $this->findBy(array(), array('productName' => 'ASC'));
    }

    public function findVisibleQuery(): ORMQueryBuilder
    {
        return $this->createQueryBuilder('p')
            ->select('p');
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

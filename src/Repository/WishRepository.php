<?php

namespace App\Repository;

use App\Entity\Wish;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Wish>
 *
 * @method Wish|null find($id, $lockMode = null, $lockVersion = null)
 * @method Wish|null findOneBy(array $criteria, array $orderBy = null)
 * @method Wish[]    findAll()
 * @method Wish[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WishRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Wish::class);
    }

    public function findBestWishes() {

        // en DQL
        /*
        $entityManager = $this -> getEntityManager();
        $dql = "
                SELECT s
                FROM App\Entity\serie s
                WHERE s.popularity > 100
                AND s.vote > 8
                ORDER BY s.popularity DESC
                ";
        $query = $entityManager->createQuery($dql);

        */


        //version QueryBuilder
        $queryBuilder = $this-> createQueryBuilder('s');

        $queryBuilder->addOrderBy('s.dateCreated', 'DESC');
        $query = $queryBuilder->getQuery();

        $query->setMaxResults(50);
        $results = $query->getResult();
        return $results;
    }
}

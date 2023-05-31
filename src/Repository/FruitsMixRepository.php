<?php

namespace App\Repository;

use App\Entity\FruitsMix;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FruitsMix>
 *
 * @method FruitsMix|null find($id, $lockMode = null, $lockVersion = null)
 * @method FruitsMix|null findOneBy(array $criteria, array $orderBy = null)
 * @method FruitsMix[]    findAll()
 * @method FruitsMix[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FruitsMixRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FruitsMix::class);
    }

    public function save(FruitsMix $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(FruitsMix $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function createOrderedByVotesQueryBuilder(string $title = null): array
    {

        $queryBuilder = $this->addOrderByVotesQueryBuilder();

        if ($title) {
            $queryBuilder->andWhere('mix.title = :title')
                ->setParameter('title', $title);
        }

        return $queryBuilder
        ->getQuery()
        ->getResult()
        ;
    }

    private function addOrderByVotesQueryBuilder(QueryBuilder $queryBuilder = null): QueryBuilder
    {
        $queryBuilder = $queryBuilder ?? $this->createQueryBuilder('mix');
        return $queryBuilder->orderBy('mix.votes', 'DESC');
    }


//    /**
//     * @return FruitsMix[] Returns an array of FruitsMix objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('f.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?FruitsMix
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

}
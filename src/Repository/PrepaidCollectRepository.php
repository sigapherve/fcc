<?php

namespace App\Repository;

use App\Entity\PrepaidCollect;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PrepaidCollect>
 *
 * @method PrepaidCollect|null find($id, $lockMode = null, $lockVersion = null)
 * @method PrepaidCollect|null findOneBy(array $criteria, array $orderBy = null)
 * @method PrepaidCollect[]    findAll()
 * @method PrepaidCollect[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrepaidCollectRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PrepaidCollect::class);
    }

    public function add(PrepaidCollect $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(PrepaidCollect $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return PrepaidCollect[] Returns an array of PrepaidCollect objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PrepaidCollect
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

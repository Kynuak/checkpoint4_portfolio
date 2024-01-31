<?php

namespace App\Repository;

use App\Entity\HarkSkill;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<HarkSkill>
 *
 * @method HarkSkill|null find($id, $lockMode = null, $lockVersion = null)
 * @method HarkSkill|null findOneBy(array $criteria, array $orderBy = null)
 * @method HarkSkill[]    findAll()
 * @method HarkSkill[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HarkSkillRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HarkSkill::class);
    }

//    /**
//     * @return HarkSkill[] Returns an array of HarkSkill objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('h')
//            ->andWhere('h.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('h.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?HarkSkill
//    {
//        return $this->createQueryBuilder('h')
//            ->andWhere('h.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

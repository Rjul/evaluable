<?php

namespace App\Repository;

use App\Entity\Review;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


class ReviewRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Review::class);
    }
    public function getAverageStarsBySeller(User $seller): float
    {
        $qb = $this->createQueryBuilder('r');
        $qb->select('AVG(r.stars) as stars')
            ->where('r.seller = :seller')
            ->setParameter('seller', $seller);
        $result = $qb->getQuery()->getSingleScalarResult();
        return $result;
    }

    public function getBySeller(User $seller, int $page = 1)
    {
        $qb = $this->createQueryBuilder('r');
        $qb->where('r.seller = :seller')
            ->setParameter('seller', $seller)
            ->orderBy('r.id', 'DESC');

        $limit = Review::LIMIT_PER_PAGE;
        $offset = ($page - 1) * $limit;

        $qb->setMaxResults($limit)
            ->setFirstResult($offset);

        $result = $qb->getQuery()->getResult();

        return $result;
    }


}

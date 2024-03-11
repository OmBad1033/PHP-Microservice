<?php

namespace App\Repository;

use App\Entity\Product;
use App\Entity\Promotion;
use DateTimeInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Promotion>
 *
 * @method Promotion|null find($id, $lockMode = null, $lockVersion = null)
 * @method Promotion|null findOneBy(array $criteria, array $orderBy = null)
 * @method Promotion[]    findAll()
 * @method Promotion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PromotionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Promotion::class);
    }

    public function findValidForProduct(Product $product,DateTimeInterface $reqDate){
        return $this->createQueryBuilder('p')->innerJoin('p.productpromotion','pp')
            ->andWhere('pp.product= :product')
            ->andWhere('pp.validTo > :reqDate or pp.validTo IS NULL')
            ->setParameter('product',$product)
            ->setParameter('reqDate',$reqDate)
            ->getQuery()
            ->getResult();

    } 

}

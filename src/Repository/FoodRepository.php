<?php

namespace App\Repository;

use App\Entity\Food;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Food>
 */
class FoodRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Food::class);
    }

    public function findAllFoodsAlphabetically(): array
    {
        return $this->createQueryBuilder('f')
            ->orderBy('LOWER(f.label)', 'ASC')
            ->orderBy('f.number', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function filterCriteria(array $criteria): QueryBuilder
    {

        $qb = $this->createQueryBuilder('f');
        foreach ($criteria as $field => $value) {

            if ($field === 'label' && str_starts_with($value, 'LIKE ')) {
                $value = substr($value, 5);
                $qb->andWhere("f.$field LIKE :$field")
                    ->setParameter($field, "%$value%");
            } else {
                $qb->andWhere("f.$field = :$field")
                    ->setParameter($field, $value);
            }
        }

        return $qb;
    }

    public function orderCriteria(QueryBuilder $qb, array $criteria): QueryBuilder
    {
        foreach ($criteria as $field => $order) {
            if ($order === null) {
                continue;
            }
            $field = strtolower($field);
            $qb->addOrderBy("f.$field", $order);
        }

        return $qb;
    }
}

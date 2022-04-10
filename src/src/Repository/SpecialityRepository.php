<?php

namespace App\Repository;

use App\Entity\Speciality;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Speciality|null find($id, $lockMode = null, $lockVersion = null)
 * @method Speciality|null findOneBy(array $criteria, array $orderBy = null)
 * @method Speciality[]    findAll()
 * @method Speciality[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SpecialityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Speciality::class);
    }

    /**
     * @return Speciality[]
     */
    public function getAllActive(): array
    {
        return $this->findBy(['isActive' => true], ['position' => 'ASC']);
    }

    /**
     * @return QueryBuilder
     */
    public function getAllActiveWithConsultations(): QueryBuilder
    {
        return $this->getEntityManager()->createQueryBuilder('s')->andWhere('s.isActive = :isActive')
            ->setParameter('isActive', true)->orderBy('s.position', 'ASC');
//            'SELECT s, c
//            FROM App\Entity\Speciality s
//            LEFT JOIN s.consultations c
//            WHERE s.isActive = :isActive'
    }
}

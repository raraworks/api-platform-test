<?php

namespace App\Repository;

use App\Entity\ClientObject;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ClientObject|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClientObject|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClientObject[]    findAll()
 * @method ClientObject[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClientObjectRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClientObject::class);
    }
}

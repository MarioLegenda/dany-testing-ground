<?php

namespace Dany\Bundle\DanyBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping;
use Doctrine\ORM\EntityManager;

class DanyEntityRepository extends EntityRepository implements DanyEntityRepositoryInterface
{
    public function __construct(
        EntityManager $em,
        string $className
    ) {
        parent::__construct($em, new Mapping\ClassMetadata($className));
    }
}
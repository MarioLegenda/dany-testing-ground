<?php

namespace Dany\Bundle\DanyBundle\Handler;

use Dany\Bundle\DanyBundle\Configuration\ModelConfigurationInterface;
use Dany\Bundle\DanyBundle\Repository\DanyEntityRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class RepositoryHandler implements RepositoryHandlerInterface
{
    /**
     * @var DanyEntityRepositoryInterface $repository
     */
    private $repository;
    /**
     * @param ModelConfigurationInterface $modelConfiguration
     * @param EntityManagerInterface $em
     * @return RepositoryHandlerInterface
     */
    public function resolve(
        ModelConfigurationInterface $modelConfiguration,
        EntityManagerInterface $em
    ) : RepositoryHandlerInterface {
        $repository = $em->getRepository($modelConfiguration->getModel());

        if (!$repository instanceof DanyEntityRepositoryInterface) {
            $model = $modelConfiguration->getModel();
            throw new \RuntimeException(
                sprintf(
                    'Could not find repository for model %s',
                    $model
                )
            );
        }

        $this->repository = $repository;

        return $this;
    }

    public function handle() : array
    {
        
    }
}
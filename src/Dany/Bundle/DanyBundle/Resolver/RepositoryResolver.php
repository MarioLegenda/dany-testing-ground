<?php

namespace Dany\Bundle\DanyBundle\Resolver;

use Dany\Bundle\DanyBundle\Configuration\ResourceHolderInterface;
use Dany\Bundle\DanyBundle\Handler\RepositoryHandlerInterface;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

class RepositoryResolver implements ArgumentValueResolverInterface
{
    /**
     * @var ResourceHolderInterface $resourceHolder
     */
    private $resourceHolder;
    /**
     * @var EntityManagerInterface $em
     */
    private $em;
    /**
     * @var RepositoryHandlerInterface $repositoryHandler
     */
    private $repositoryHandler;
    /**
     * RepositoryHandler constructor.
     * @param ResourceHolderInterface $resourceHolder
     * @param RepositoryHandlerInterface $repositoryHandler
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        RepositoryHandlerInterface $repositoryHandler,
        ResourceHolderInterface $resourceHolder,
        EntityManagerInterface $entityManager
    ) {
        $this->resourceHolder = $resourceHolder;
        $this->repositoryHandler = $repositoryHandler;
        $this->em = $entityManager;
    }

    public function supports(Request $request, ArgumentMetadata $argument)
    {
        if (RepositoryHandlerInterface::class !== $argument->getType()) {
            return false;
        }

        return true;
    }

    public function resolve(Request $request, ArgumentMetadata $argument)
    {
         yield $this->repositoryHandler->resolve(
             $this->resourceHolder->getResource()->getModelConfiguration(),
             $this->em
         );
    }
}
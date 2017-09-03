<?php

namespace Dany\Bundle\DanyBundle\Resolver;

use Dany\Bundle\DanyBundle\Handler\SerializationHandlerInterface;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

class SerializationResolver implements ArgumentValueResolverInterface
{
    /**
     * @var SerializationHandlerInterface $serializationHandler
     */
    private $serializationHandler;
    /**
     * RepositoryHandler constructor.
     * @param SerializationHandlerInterface $serializationHandler
     */
    public function __construct(
        SerializationHandlerInterface $serializationHandler
    ) {
        $this->serializationHandler = $serializationHandler;
    }

    public function supports(Request $request, ArgumentMetadata $argument)
    {
        if (SerializationHandlerInterface::class !== $argument->getType()) {
            return false;
        }

        return true;
    }

    public function resolve(Request $request, ArgumentMetadata $argument)
    {
        yield $this->serializationHandler;
    }
}
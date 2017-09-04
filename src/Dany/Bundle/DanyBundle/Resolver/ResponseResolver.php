<?php

namespace Dany\Bundle\DanyBundle\Resolver;

use Dany\Bundle\DanyBundle\Handler\ResponseHandlerFactory;
use Dany\Bundle\DanyBundle\Handler\ResponseHandlerInterface;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Dany\Bundle\DanyBundle\Configuration\ResourceHolderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

class ResponseResolver implements ArgumentValueResolverInterface
{
    /**
     * @var ResourceHolderInterface $resourceHolder
     */
    private $resourceHolder;
    /**
     * @var ResponseHandlerFactory $responseHandlerFactory
     */
    private $responseHandlerFactory;
    /**
     * RepositoryHandler constructor.
     * @param ResourceHolderInterface $resourceHolder
     * @param ResponseHandlerFactory $responseHandlerFactory
     */
    public function __construct(
        ResourceHolderInterface $resourceHolder,
        ResponseHandlerFactory $responseHandlerFactory
    ) {
        $this->resourceHolder = $resourceHolder;
        $this->responseHandlerFactory = $responseHandlerFactory;
    }

    public function supports(Request $request, ArgumentMetadata $argument)
    {
        if (ResponseHandlerInterface::class !== $argument->getType()) {
            return false;
        }

        return true;
    }
    /**
     * @param Request $request
     * @param ArgumentMetadata $argument
     * @return ResponseHandlerInterface
     */
    public function resolve(Request $request, ArgumentMetadata $argument)
    {
        $resource = $this->resourceHolder->getResource();

        yield $this->responseHandlerFactory->resolveResponseHandler(
            $resource->getResponseConfiguration()->getFormat()
        );
    }
}
<?php

namespace Dany\Bundle\DanyBundle\Controller;

use Dany\Bundle\DanyBundle\Configuration\ResourceHolderInterface;
use Dany\Bundle\DanyBundle\Handler\RepositoryHandlerInterface;
use Dany\Bundle\DanyBundle\Handler\ResponseHandlerInterface;
use Dany\Bundle\DanyBundle\Handler\SerializationHandlerInterface;
use Symfony\Component\HttpFoundation\Request;

class NoFlowController
{
    /**
     * @var ResourceHolderInterface $resourceProvider
     */
    private $resourceHolder;
    /**
     * NoFlowController constructor.
     * @param ResourceHolderInterface $resourceHolder
     */
    public function __construct(
        ResourceHolderInterface $resourceHolder
    ) {
        $this->resourceHolder = $resourceHolder;
    }
    /**
     * @param Request $request
     * @param RepositoryHandlerInterface $repositoryHandler
     * @param SerializationHandlerInterface $serializationHandler
     * @param ResponseHandlerInterface $responseHandler
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function noFlowAction(
        Request $request,
        RepositoryHandlerInterface $repositoryHandler,
        SerializationHandlerInterface $serializationHandler,
        ResponseHandlerInterface $responseHandler
    ) {
        $resources = $repositoryHandler->handle();
        $format = $this->resourceHolder->getResource()->getResponseConfiguration()->getFormat();
        $serialized = $serializationHandler->serialize($resources, $format);

        return $responseHandler->getResponse($serialized);
    }
}
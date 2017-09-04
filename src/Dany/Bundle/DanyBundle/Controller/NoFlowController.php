<?php

namespace Dany\Bundle\DanyBundle\Controller;

use Dany\Bundle\DanyBundle\Configuration\ResourceHolderInterface;
use Dany\Bundle\DanyBundle\Handler\RepositoryHandlerInterface;
use Dany\Bundle\DanyBundle\Handler\SerializationHandlerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class NoFlowController extends Controller
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

    public function noFlowAction(
        Request $request,
        RepositoryHandlerInterface $repositoryHandler,
        SerializationHandlerInterface $serializationHandler
    ) {
        $resources = $repositoryHandler->handle();

        $response = new Response();
        $response->setContent($serializationHandler->serialize($resources));
        $response->headers->set('CONTENT-TYPE', 'application/json');

        return $response;
    }
}
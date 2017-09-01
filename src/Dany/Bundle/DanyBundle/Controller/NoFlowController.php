<?php

namespace Dany\Bundle\DanyBundle\Controller;

use Dany\Bundle\DanyBundle\Configuration\ResourceHolderInterface;
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

    public function noFlowAction(Request $request)
    {
        $resource = $this->resourceHolder->getResource();
        $modelConfiguration = $resource->getModelConfiguration();

        $model = $modelConfiguration->getModel();
    }
}
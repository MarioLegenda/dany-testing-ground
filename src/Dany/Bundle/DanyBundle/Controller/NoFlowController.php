<?php

namespace Dany\Bundle\DanyBundle\Controller;

use Dany\Bundle\DanyBundle\Configuration\ResourceSearchProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class NoFlowController
{
    /**
     * @var ResourceSearchProviderInterface $resourceProvider
     */
    private $resourceProvider;

    /**
     * NoFlowController constructor.
     * @param ResourceSearchProviderInterface $resourceSearchProvider
     */
    public function __construct(
        ResourceSearchProviderInterface $resourceSearchProvider
    ) {
        $this->resourceProvider = $resourceSearchProvider;
    }

    public function noFlowAction(Request $request)
    {
        return new Response('response returned');
    }
}
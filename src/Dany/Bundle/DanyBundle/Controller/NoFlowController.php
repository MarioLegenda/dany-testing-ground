<?php

namespace Dany\Bundle\DanyBundle\Controller;

use Dany\Bundle\DanyBundle\Configuration\ResourceSearchProviderInterface;
use Dany\Library\CollectionInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class NoFlowController
{
    /**
     * @var CollectionInterface $resourceProvider
     */
    private $resourceConfiguration;

    /**
     * NoFlowController constructor.
     * @param CollectionInterface $resourceConfiguration
     */
    public function __construct(
        CollectionInterface $resourceConfiguration
    ) {
        $this->resourceConfiguration = $resourceConfiguration;
    }

    public function noFlowAction(Request $request)
    {
        return new Response('response returned');
    }
}